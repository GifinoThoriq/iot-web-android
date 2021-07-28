<?php 

session_start();

//cek session
if(!isset($_SESSION["login"])){
    header("location: index.php");
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/Dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&display=swap" rel="stylesheet">

    <!-- <link rel="stylesheet" href="styles/bootstrap/bootstrap.min.css"> -->

    <title> dashboard </title>

    <script type="text/javascript" src="js/jquery.min.js"></script>

    <!-- load realtime  -->
    <script type="text/javascript">
        var refreshid = setInterval(function() {
            $('#suhu').load('dashboard-table/data-suhu.php');
            $('#tds').load('dashboard-table/data-tds.php');
            $('#suhuAir').load('dashboard-table/data-suhuAir.php');
            $('#kelembaban').load('dashboard-table/data-kelembaban.php');
            $('#statusPump').load('dashboard-table/data-status.php');
        }, 1000);
    </script>

</head>

<body>

    <!-- membuat nav disamping -->
    <nav>
        <div class="logo">
            <h2>DIVON</h2>
        </div>
        <div class="isi">
            <div class="isi-child">
                <img src="imgOno/icon-dashboard.png" alt="">
                <span>Dashboard</span>
            </div>
            <div class="isi-child" onclick="location.href='dashboard-graph/dashboard-graph.php';">
                <img src="imgOno/icon-statistic.png" alt="">
                <span>Statistic</span>
            </div>
        </div>
        <div class="logout" id="logout">
            <img src="imgOno/icon-logout.png" alt="">
            <span>Logout</span>
        </div>
    </nav>
    <!-- membuat nav disamping -->

    <!-- membuat tempat profile -->
    <div class="profile">
        <span>Gifino</span>
        <img src="imgOno/profil1.png" alt="">
    </div>
    <!-- membuat tempat profile -->


    <!-- main content -->
    <div class="main">

        <h2>Table</h2>


        <div class="card-container">
            <!-- card status suhu -->
            <div class="card">
                <div class="card-header" style="font-size:20px; font-weight:bold;">
                    Suhu
                </div>
                <div class="card-body">
                    <h1> <span id="suhu">0</span></h1>
                </div>
            </div>
            <!-- card status suhu-->


            <!-- card status tds -->
            <div class="card">
                <div class="card-header" style="font-size:20px; font-weight:bold;">
                    Tds
                </div>
                <div class="card-body">
                    <h1><span id="tds">0</span></h1>
                </div>
            </div>
            <!-- card status tds -->

            <!-- card status suhu air -->
            <div class="card">
                <div class="card-header" style="font-size:20px; font-weight:bold;">
                    suhu air
                </div>
                <div class="card-body">
                    <h1><span id="suhuAir">0</span></h1>
                </div>
            </div>
            <!-- card status air -->

            <!-- card status kelembaban -->
            <div class="card">
                <div class="card-header" style="font-size:20px; font-weight:bold;">
                    kelembaban
                </div>
                <div class="card-body">
                    <h1><span id="kelembaban">0</span></h1>
                </div>
            </div>
            <!-- card status kelembaban -->

            <!-- card status kelembaban -->
            <div class="card">
                <div class="card-header" style="font-size:20px; font-weight:bold;">
                    status pump
                </div>
                <div class="card-body">
                    <h1><span id="statusPump">mati</span></h1>
                </div>
            </div>
            <!-- card status kelembaban -->


        </div>
    </div>
    
    <script>
        var btn = document.getElementById('logout');
        btn.addEventListener('click', function() {
        document.location.href = '<?php echo "logout.php"; ?>';
        });
    </script>

</body>

</html>