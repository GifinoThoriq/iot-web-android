<?php

    require 'connectDB.php';






    $tds=$data['tds'];

    //uji apabila nilai tds belum ada maka anggap tds = 0
    if($tds == "") $tds=0;


    //cetak nilai tds
    echo $tds;


?>