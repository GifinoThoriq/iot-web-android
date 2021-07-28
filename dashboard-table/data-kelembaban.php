<?php 

require 'connectDB.php';

$kelembaban = $data['kelembaban'];

//jika tidak ada di anggap kosong
if ($kelembaban == "") $kelembaban = "";


//cetak nilai suhu
echo $kelembaban;

?>