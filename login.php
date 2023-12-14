<?php
include("koneksi.php");
session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE userid = ? OR username = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $username, $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($password === $row['password']) {
            // Login sukses
            $_SESSION['users'] = $row;
            header('Location: index.php?statuslogin=sukses');
            exit;
        } else {
            // Password tidak cocok
            header('Location: login.php?statuslogin=gagal&reason=password');
            exit;
        }
    } else {
        // Akun tidak ditemukan
        header('Location: login.php?statuslogin=gagal&reason=notfound');
        exit;
    }
} else {
    die("Akses terlarang!");
}
?>
