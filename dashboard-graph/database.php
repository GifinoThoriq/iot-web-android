<?php 

    //koneksi database
    $conn = mysqli_connect('localhost', 'root', '','grafik');

    //baca ID tertinggi
    $sql_Id = mysqli_query($conn, "SELECT MAX(id) FROM tb_sensor");

    $data_Id = mysqli_fetch_array($sql_Id);
    
    $Id_akhir = $data_Id['MAX(id)'];

    $Id_awal = $Id_akhir - 4;

    //baca tanggal semua data(menjadi sumbu x)
    $date = mysqli_query($conn, "SELECT tanggal FROM tb_sensor WHERE id >= '$Id_awal' AND id <= '$Id_akhir' ORDER BY id ASC");

    //baca suhu untuk semua data(menjadi sumbu y)
    $temp = mysqli_query($conn, "SELECT suhu FROM tb_sensor WHERE id >= '$Id_awal' AND id <= '$Id_akhir' ORDER BY id ASC");

    //baca tds untuk semua data(menjadi sumbu y)
    $tds = mysqli_query($conn, "SELECT tds FROM tb_sensor WHERE id >= '$Id_awal' AND id <= '$Id_akhir' ORDER BY id ASC");

    //baca suhu air untuk semua data(menjadi sumbu y)
    $tempAir = mysqli_query($conn, "SELECT suhuAir FROM tb_sensor WHERE id >= '$Id_awal' AND id <= '$Id_akhir' ORDER BY id ASC");

    //baca suhu air untuk semua data(menjadi sumbu y)
    $kelembaban = mysqli_query($conn, "SELECT kelembaban FROM tb_sensor WHERE id >= '$Id_awal' AND id <= '$Id_akhir' ORDER BY id ASC");

?>