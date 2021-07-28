<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/Dashboard-graph.css">
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&display=swap" rel="stylesheet">
    <title> dashboard </title>




</head>

<body>

    <!-- membuat nav disamping -->
    <nav>
        <div class="logo">
            <h2>DIVON</h2>
        </div>
        <div class="isi">
            <div class="isi-child" onclick="location.href='../dashboard.php';">
                <img src="../imgOno/icon-dashboard.png" alt="">
                <span>Dashboard</span>
            </div>
            <div class="isi-child active" onclick="location.href='dashboard-graph.php';">
                <img src="../imgOno/icon-statistic.png" alt="">
                <span>Statistic</span>
            </div>
        </div>
        <div class="logout" id="logout">
            <img src="../imgOno/icon-logout.png" alt="">
            <span>Logout</span>
        </div>
    </nav>
    <!-- membuat nav disamping -->

    <!-- membuat tempat profile -->
    <div class="profile">
        <span>Gifino</span>
        <img src="../imgOno/profil1.png" alt="">
    </div>
    <!-- membuat tempat profile -->


    <!-- membuat konten -->
    <div class="main">

        <!-- pilihan grafik -->

        <select name="pilihGrafik" id="pilihGrafik" class="custom-select" onchange="gantiChart();">
            <option value="">--pilih grafik--</option>
            <option value="naLine" >Nutrisi Air-Line</option>
            <option value="naBar" >Nutrisi Air-Bar</option>
            <option value="srLine" >Suhu Ruangan-Line</option>
            <option value="srBar" >Suhu Ruangan-Bar</option>
         </select>




        <!-- pilihan grafik -->


         <!-- membuat grafik -->
        
            <div class="container-grafik">
                <div class="child-grafik" id="grafik" style="width:80%; text-align:center;"></div>
            </div>

         <!-- membuat grafik -->


    </div>
     <!-- membuat konten -->

    <script type = "text/javascript" src="../js/jquery-3.4.0.min.js"></script>
    <script type = "text/javascript" src="../js/mdb.min.js"></script>
    <script type = "text/javascript" src="jquery-latest.js"></script>

    <!-- memanggil chart -->
    <script type = "text/javascript">

        //chart secara default
        var chart = 'chart-line.php';

        // mengganti chart sesuai pilihan
        function gantiChart(){
            var x = document.getElementById("pilihGrafik").selectedIndex;
            var opt = document.getElementsByTagName("option")[x].value;

            if(opt === "naLine"){
                return chart = 'chart-line.php'

            }if (opt === "naBar"){
                return chart = 'chart-bar.php'

            }if(opt === "srLine"){
                return chart = 'grafik-dht-line.php'

            }if(opt==="srBar"){
                return chart = 'grafik-dht-bar.php'
            }
        }

        console.log(chart);

        var refreshid = setInterval(function(){
            $('#grafik').load(chart);
        }, 1000);
    </script>

    <script>
        var btn = document.getElementById('logout');
        btn.addEventListener('click', function() {
        document.location.href = '<?php echo "../logout.php"; ?>';
        });
    </script>
</body>

</html>