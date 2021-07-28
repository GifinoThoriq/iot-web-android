<?php 

require 'connectDB.php';

$statusPump = $data['statusPump'];

//jika tidak ada di anggap kosong
if ($statusPump == "") $statusPump = "";


//cetak nilai suhu
echo $statusPump;

?>