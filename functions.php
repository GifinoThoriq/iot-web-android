<?php 

//koneksi ke database
$conn = mysqli_connect("localhost","root", "", "grafik");

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);

    //cek berhasil atau tidak
    if(!$result){
        echo mysqli_error($result);
    }

    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }

    return $rows;
}

function registrasi($data){
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn,$data["password"]);
    $cpassword = mysqli_real_escape_string($conn,$data["cpassword"]);
    


    //cek username agak tidak double
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    
    if(mysqli_fetch_assoc($result)){
        echo "<script>
            alert('username sudah terdaftar!');
        </script>";
        
        return false;
    }

    //cek konfirmasi password
    if($password !== $cpassword){
        echo "<script>
            alert('password tidak sesuai!');
        </script>";

        return false;
    }

    //enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);
    
    //tambahkan user baru
    mysqli_query($conn, "INSERT INTO user VALUES('','$username','$password','')");

    return mysqli_affected_rows($conn);
}

?>