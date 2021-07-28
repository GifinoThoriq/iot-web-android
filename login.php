<?php 

    session_start();
    
    if(isset($_SESSION["login"])){
        header("Location: dashboard.php");
        exit;
    }

    require 'functions.php';

    if(isset($_POST["login"])){
         
        $username = $_POST["username"];
        $password = $_POST["password"];

        $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

        //cek username
        if(mysqli_num_rows($result) === 1){

            $row = mysqli_fetch_assoc($result);
            
            //cek password
            if(password_verify($password,$row['password'])){
                
                //set session
                $_SESSION["login"] = true;            
                header("Location: dashboard.php");
                exit;
            }
        }

        $error = true;
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&display=swap" rel="stylesheet">
    <title>Login</title>
</head>
<body>
<div class="container">
        <div class="signup">
            <div class="kotak-kiri">
                <div class="logo">
                    <h2>DIVON</h2>
                </div>
                <div class="judul">
                    <h2>Log In</h2>
                    <h3>Log in to continue</h3>
                </div>
                <div class="formulir">
                    <form action="" method="post">

                        <?php if(isset($error)):?>
                            <p style="color:red; opacity: 0.5; font-size: 12px; margin-bottom: -12px;">username/password salah</p>
                        <?php endif;?>

                        <input type="text" name="username" placeholder="username" autofocus = "off" value="">
                        <input type="password" name="password" placeholder="password" autofocus = "off" value="">

                        <div class="btnLogin">
                            <button type="submit" name="login">Login</button>
                        </div>
                        
                    </form>
                </div>
                <!-- <div class="btnSignUp">
                    <p>Doesn't have an account? <a href="signup.php">Sign Up</a> here</p>
                </div> -->
            </div>
            <div class="kotak-kanan">
                <img src="imgOno/login1.svg" alt="dunia">
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/891b41940f.js%22%3E"></script>
</body>
</html>