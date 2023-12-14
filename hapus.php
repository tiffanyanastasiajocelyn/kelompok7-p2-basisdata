<?php
include("koneksi.php");
session_start();

if( isset($_GET['id']) ){

    $id=$_GET['id'];

    $query = "DELETE FROM `form_makanan` WHERE id=?";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $id);

    $result = mysqli_stmt_execute($stmt);

    if($result){
        header('Location: history.php');
    } else {
        echo "gagal menghapus...". mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
} else {
    // Akses terlarang jika tidak ada parameter id
    die("Akses terlarang!");
}
?>