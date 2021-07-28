<?php 

require 'functions.php';

if( isset($_POST["signup"])){

    if(registrasi($_POST) > 0){
        echo "<script>
            alert('registrasi sukses');
            exit;
        </script>;";

        header("Location: login.php");
        exit;
    }else{
        echo mysqli_error($conn);
    }
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
                    <h2>Sign Up</h2>
                    <h3>Create your account</h3>
                </div>
                <div class="formulir">
                    <form action="" method="post">
                        <input type="text" name="username" placeholder="username" autofocus = "off" value="">
                        <input type="password" name="password" placeholder="password" autofocus = "off" value="">
                        <input type="password" name="cpassword" placeholder="confirm password" autofocus = "off" value="">
                        <div class="btnLogin">
                            <button type="submit" name="signup" id="signup">Sign Up</button>
                        </div>
                    </form>
                </div>
                <div class="btnSignUp" style="margin-top: 32px;">
                    <p> have an account? <a href="login.php">Log In</a> here</p>
                </div>
            </div>
            <div class="kotak-kanan">
                <img src="imgOno/dunia2.svg" alt="dunia">
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/891b41940f.js%22%3E"></script>
</body>
</html>