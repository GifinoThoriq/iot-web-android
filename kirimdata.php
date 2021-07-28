<?php 

$conn = mysqli_connect('localhost', 'root', '', 'grafik');
$suhu = $_GET['suhu'];
$tds = $_GET['tds'];
$suhuAir = $_GET['suhuAir'];
$kelembaban = $_GET['kelembaban'];
$statusPump = $_GET['statusPump'];



//kirim data ke server
mysqli_query($conn, "ALTER TABLE tb_sensor AUTO_INCREMENT=1");
$simpan = mysqli_query($conn,"INSERT INTO tb_sensor(suhu, tds, suhuAir, kelembaban, statusPump) VALUES('$suhu','$tds','$suhuAir','$kelembaban','$statusPump')");


//berikan response ke nodeMCU
if($simpan){
    echo "berhasil disimpan";
}else{
    echo "gagal tersimpan";
}
?>

