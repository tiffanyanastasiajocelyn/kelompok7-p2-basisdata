<?php
include("koneksi.php");
session_start();

if(isset($_POST['register'])){


    $userid = $_POST['userid'];
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    $query = "INSERT INTO users(userid, username, fullname, email, password) VALUES ('$userid','$username','$fullname','$email','$password')";

    if( (mysqli_query($conn, $query))==TRUE) {
        header('location: login.html?statusdaftar=sukses');
    } else {
        header('location: register.html?statusdaftar=gagal');
    }
} else {
    die("Akses terlarang!");
}
?>