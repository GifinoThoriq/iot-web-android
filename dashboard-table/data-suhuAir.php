<?php 

require 'connectDB.php';

$suhuAir = $data['suhuAir'];

//jika tidak ada di anggap kosong
if ($suhuAir == "") $suhuAir = "";


//cetak nilai suhu
echo $suhuAir;

?>