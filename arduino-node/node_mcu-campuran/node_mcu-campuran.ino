//libraries lcd
#include <LiquidCrystal_I2C.h>


//libraries communication
#include<SoftwareSerial.h>

//library wifi
#include<ESP8266HTTPClient.h>
#include<ESP8266WiFi.h>

//library firebase
#include <FirebaseArduino.h>


#define FIREBASE_HOST "" //link of realtime db firebase      
#define FIREBASE_AUTH "" //your db secret     

char ssid[] = ""; //Wifi name
char pass[] = ""; //Wifi password

//ip address server
const char*  server = "";


WiFiClient wifiClient;

SoftwareSerial DataSerial(12, 13);

unsigned long previousMillis = 0;
const long interval = 1000;

String arrData[4];

LiquidCrystal_I2C lcd(0x27, 16, 2);

float tds;
float suhu;
float suhuAir;
float kelembaban;
String statusPump;



void setup(){
  
 Serial.begin(9600);
 //setup lcd
 lcd.begin(16,2);
 lcd.init();
 lcd.backlight();


  

  
 //koneksi wifi
 WiFi.begin(ssid, pass);


 //cek koneksi
 while(WiFi.status() != WL_CONNECTED)
 {
   //mencoba koneksi lagi
   lcd.setCursor(0,0);
   lcd.print("mencoba");
   lcd.setCursor(0,1);
   lcd.print("...");
   delay(500);
 }

 //berhasil terkoneksi
 lcd.setCursor(0,0);
 lcd.print("berhasil");
 lcd.setCursor(0,1);
 lcd.print("terkoneksi");

 //print IP address
  Serial.print("Use this URL to connect: ");
  Serial.print("http://");
  Serial.print(WiFi.localIP());

 
  DataSerial.begin(9600);
  Firebase.begin(FIREBASE_HOST, FIREBASE_AUTH); 

 
}

int n = 0;

void loop() {

  
  
  //mengolah data dari arduino setiap 1 detik
  unsigned long currentMillis = millis();
  if(currentMillis - previousMillis > interval)
  {
    previousMillis = currentMillis;

    //baca dari arduino
    String data = "";
    while(DataSerial.available() > 0)
    {
      data += char(DataSerial.read());
    }
    data.trim();

    if( data != "")
    {
      //memecahkan data dari arduino
      int index = 0;
      for(int i = 0;i <= data.length(); i++)
      {
        char delimiter = '#';
        if(data[i] != delimiter)
        {
          arrData[index] += data[i];
        }else
        {
          index++;
        }
      }

      //cek pembacaan data
      if(index == 3)
      {
        lcd.setCursor(0,0);
        lcd.print("suhu: " + arrData[2] + " C");
        Serial.println("suhu: " + arrData[2] + " C"); //nilai suhu ruangan
        lcd.setCursor(0,1);
        lcd.print("tds: " + arrData[1] + " PPM");
        Serial.println("tds: " + arrData[1] + " PPM"); //nilai tds
        Serial.println("suhu air: " + arrData[0] + " C"); //nilai suhu air
        Serial.println("kelembaban: " + arrData[3]); // nilai kelembaban

        //cek pump
        if(arrData[1].toInt() < 50){
           statusPump = "nyala";
        }else{
          statusPump = "mati";
        }

        Serial.println("status pump: " + statusPump);
        
      }

      //tampung nilai dari arduino
      suhuAir = arrData[0].toFloat();
      tds = arrData[1].toFloat();
      suhu = arrData[2].toFloat();
      kelembaban = arrData[3].toFloat();

      //kirim data ke sql
      kirimSql();

      //kirim data ke firebase
      kirimFirebase();
            
      //kosongkan data
      arrData[0] = "";
      arrData[1] = "";
      arrData[2] = "";
      arrData[3] = "";
      statusPump = "";
    }

    //minta data dari ke arduino
    DataSerial.println("Y");
  }
}


void kirimSql(){
  //cek koneksi nodemcu ke webserver
  WiFiClient client;
  const int httpPort = 80;
  if(!client.connect(server,httpPort)){
    Serial.println("koneksi gagal ke webserver");
    arrData[0] = "";
    arrData[1] = "";
    arrData[2] = "";
    arrData[3] = "";
    statusPump = "";
    return;
   }
   
  //kirim data ke database jika berhasil
  HTTPClient http;
  String Link = "http://" + String(server) + "/webapp/IoT-web/kirimdata.php?suhuAir=" + String(suhuAir) + "&tds=" + String(tds) + "&suhu="+ String(suhu) + "&kelembaban=" + String(kelembaban) + "&statusPump=" + String(statusPump);

  
  //eksekusi link url
  http.begin(wifiClient,Link);
  http.GET();

  //tangkap respon kirimdata
  String response = http.getString();
  Serial.println(response);
  
  //kosongkan data
  arrData[0] = "";
  arrData[1] = "";
  arrData[2] = "";
  arrData[3] = "";
  statusPump = "";
   
}

void kirimFirebase(){
      //set value di firebase
      Firebase.setFloat("suhuAir", suhuAir);
      Firebase.setFloat("tds", tds);
      if(tds < 50){
        Firebase.setString("statusPump", "nyala");
      }else{
        Firebase.setString("statusPump", "mati");
      }
      Firebase.setFloat("suhu", suhu);
      Firebase.setFloat("kelembaban", kelembaban);
      if(Firebase.failed()) {
        Serial.print("setting/ message failed: ");
        Serial.println(Firebase.error());
        return;
      }

      delay(1000);


      //menghitung sudah berapa kali membaca sensor
      String name = Firebase.pushInt("logs", n++);
      if(Firebase.failed()){
        Serial.print("pushing/logs failed:");
        Serial.println(Firebase.error());
        return;
      }
      Serial.print("pushed: /logs/");
      Serial.println(name);
      delay(1000);
}
