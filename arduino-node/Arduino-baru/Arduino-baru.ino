#include <EEPROM.h>
#include "GravityTDS.h"

#include <OneWire.h>
#include<DallasTemperature.h>

#define ONE_WIRE_BUS 8
#define TdsSensorPin A0


GravityTDS gravityTds;


OneWire oneWire(ONE_WIRE_BUS);

DallasTemperature sensors(&oneWire);



#include <dht.h>  // Include library dht
#define outPin 10

dht DHT;

float tdsValue;
float temp;
float tempDHT;
float h;
String statusPump;

int pump1 = 6;


unsigned long previousMillis;

const long interval = 3000;

void setup()
{
    Serial.begin(9600);
    gravityTds.setPin(TdsSensorPin);
    gravityTds.setAref(5.0);  //reference voltage on ADC, default 5.0V on Arduino UNO
    gravityTds.setAdcRange(1024);  //1024 for 10bit ADC;4096 for 12bit ADC
    gravityTds.begin();  //initialization
    sensors.begin();

    pinMode(pump1,OUTPUT);
    
}


void kirimData()
{
  String dataKirim = String(temp) + '#' + String(tdsValue) + '#' + String(tempDHT) + '#' + String(h);
  Serial.println(dataKirim);
}

void loop()
{
    sensors.requestTemperatures(); //get temp from lib
    temp = sensors.getTempCByIndex(0); // read temperature of the water 
  
    gravityTds.setTemperature(temp);  // set the temperature and execute temperature compensation
    gravityTds.update();  //sample and calculate
    tdsValue = gravityTds.getTdsValue();  // then get the value

    int readData = DHT.read11(outPin);
    tempDHT = DHT.temperature;  // Read temperature ruangan
    h = DHT.humidity; //Read humidity


 
    //baca permintaan dari NodeMcu
    String minta = "";
    while (Serial.available() > 0)
    {
      minta += char(Serial.read());
    }

    minta.trim();
    if (minta == "Y")
    {
      kirimData();
    }


    minta = " ";
    delay(1000);




    unsigned long currentMillis = millis();
    
    if (currentMillis - previousMillis > interval)
    {
    previousMillis = currentMillis;
    if (tdsValue < 50) {
      digitalWrite(pump1, LOW);//pump nyala
      
    } else
    {
      digitalWrite(pump1, HIGH);//pump mati
    }
  }

  
    
}
