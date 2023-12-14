<?php
include("koneksi.php");
session_start();

if (isset($_POST['simpan_perubahan'])) {

    // Ambil data dari formulir
    $id = $_POST['id'];
    $nama_makanan = $_POST['nama_makanan'];
    $kalori = $_POST['kalori'];
    $tanggal = $_POST['tanggal'];

    // Prepare the SQL statement
    $query = "UPDATE `form_makanan` SET `nama_makanan`=?, `kalori`=?, `tanggal`=? WHERE `id`=?";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $query);

    // Check if statement was successfully prepared
    if ($stmt) {
        // Bind parameters to the statement
        mysqli_stmt_bind_param($stmt, "sisi", $nama_makanan, $kalori, $tanggal, $id);

        // Execute the statement
        $cek = mysqli_stmt_execute($stmt);

        // Check if execution was successful
        if ($cek) {
            header('Location: history.php?statusedit=sukses');
        } else {
            header('Location: history.php?statusedit=gagal&error=' . mysqli_error($conn));
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // If failed to prepare statement
        header('Location: history.php?statusedit=gagal&error=' . mysqli_error($conn));
    }
} else {
    // If the Edit button wasn't pressed
    die("Akses terlarang!");
}
?>
