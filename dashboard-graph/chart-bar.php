<?php

    require 'database.php';

?>

<!-- Menampilkan Grafik -->
<div>
        <h2>Grafik Sensor TDS</h2>
    </div>

    <div class="panel-body">
        <!-- canvas untuk grafik -->
        <canvas id="myChart"></canvas>

        <!-- gambar grafik -->
        <script>
            var canvas = document.getElementById('myChart');

            // letakkan data tanggal dan suhu
            var data = {
                labels : [
                    <?php
                        while($data_tanggal = mysqli_fetch_assoc($date))
                        {
                            echo '"'.$data_tanggal['tanggal'].'",';
                        }    
                    ?>
                ],
                datasets :[{
                    label : "suhu air",
                    fill: true,
                    backgroundColor: "rgba(138,240,133, 0.2)",
                    borderColor: "rgba(138,240,133, 1)",
                    lineTension: 0.5,
                    pointRadius: 5,
                    data : [
                        <?php
                            while($data_suhu = mysqli_fetch_assoc($tempAir))
                            {
                                echo $data_suhu['suhuAir'].',';
                            }    
                        ?>
                    ]
                },
                {
                    label : "tds",
                    fill: true,
                    backgroundColor: "rgba(239,82,93, 0.2)",
                    borderColor: "rgba(239,82,93, 1)",
                    lineTension: 0.5,
                    pointRadius: 5,
                    data : [
                        <?php
                            while($data_tds = mysqli_fetch_assoc($tds))
                            {
                                echo $data_tds['tds'].',';
                            }    
                        ?>
                    ]
                }
                
                ]
            };


            // option grafik
            var option = {
                showLines : true,
                animation : {duration : 0}
            };

            // cetak kedalam canvas
            var myLineChart = Chart.Bar(canvas, {
                data : data,
                options : option
            });
        </script>
    </div>
</div>