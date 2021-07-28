<?php

require 'connectDB.php';


$suhu = $data['suhu'];

//uji apabila nilai suhu belum ada maka anggap suhu = 0
if ($suhu == "") $suhu = 0;


//cetak nilai suhu
echo $suhu;
?>