<?php
include("koneksi.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];

    // Prepare the statement to prevent SQL injection
    $stmt = mysqli_prepare($conn, "SELECT * FROM form_makanan WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_array($result);
}
?>



<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="kalori.css">
    <style>
        @font-face {
            font-family: font1;
            src: url(font/Mont-HeavyDEMO.otf);
        }
        @font-face {
            font-family: font2;
            src: url(font/Mont-ExtraLightDEMO.otf);
        }
    </style>
</head>

<body>
<div class="input">
        <div class="judul">
        <h1>Edit your food and beverages</h1>
      </div>
  <form action="prosesedit.php" method="POST">
      <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
      <div class="box-input">
      <h2>Kamu makan apa nih?</h2>
        <input type="text" name="nama_makanan" value="<?php echo $user['nama_makanan']; ?>">
      </div>
      <div class="box-input">
      <h2>Berapa kalorinya?</h2>
        <input type="number" name="kalori" value="<?php echo $user['kalori']; ?>">
      </div>
      <div class="box-input">
      <h2>Makannya kapan?</h2>
        <input type="date" name="tanggal" value="<?php echo $user['tanggal']; ?>">
      </div>
      <p>
        <a href="history.php">
                <button type="submit" name="simpan_perubahan" class="submit">save</button>
            </a>
      </p>
  </form>
</body>
</html>