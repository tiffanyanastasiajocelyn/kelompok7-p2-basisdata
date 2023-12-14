<?php
include("koneksi.php");
session_start();

if(isset($_POST['submit'])){

    $userid = $_SESSION['users']['userid'];
    $nama_makanan = $_POST['nama_makanan'];
    $kalori = $_POST['kalori'];
    $tanggal = $_POST['tanggal'];

    // Prepare statement untuk form_makanan
    $stmt = mysqli_prepare($conn, "INSERT INTO form_makanan (userid, nama_makanan, kalori, tanggal) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, 'isis', $userid, $nama_makanan, $kalori, $tanggal);

    // Eksekusi dan cek jika berhasil
    if(mysqli_stmt_execute($stmt)){
        $last_id = mysqli_insert_id($conn); // Mendapatkan ID terakhir yang dimasukkan

        // Prepare statement untuk history
        $stmt_history = mysqli_prepare($conn, "INSERT INTO history (id, submit_date) VALUES (?, CURRENT_TIMESTAMP)");
        mysqli_stmt_bind_param($stmt_history, 'i', $last_id);

        // Eksekusi statement untuk history
        if(mysqli_stmt_execute($stmt_history)){
            header('Location: history.php?statusdaftar=sukses');
        } else {
            $error = mysqli_error($conn);
            header("Location: history.php?statusdaftar=gagal&error=" . urlencode($error));
        }
        mysqli_stmt_close($stmt_history);

    } else {
        $error = mysqli_error($conn);
        header("Location: history.php?statusdaftar=gagal&error=" . urlencode($error));
    }
    mysqli_stmt_close($stmt);

} else {
    die("Terjadi kesalahan sistem");
}
?>
