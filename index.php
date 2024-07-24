<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require 'functions.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <style>
        .loading {
            width: 100px;
            position: absolute;
            top: 80px;
            left: 620px;
            z-index: -1;
            display: none;
        }
    </style>
</head>

<body>
    <h1>Daftar Buku</h1>
    <a href="tambah.php">Tambah Data</a>
    <a href="logout.php">Log-out</a>
    <br><br>


    <form target="_blank" action="cetak.php" method="get">
        <select class="form-control" id="Kolom" name="Kolom" required="">
            <?php
            $kolom = (isset($_GET['Kolom'])) ? $_GET['Kolom'] : "";
            ?>
            <option value="nama" <?php if ($kolom == "nama") echo "selected"; ?>>Nama Buku</option>
            <option value="jenis" <?php if ($kolom == "jenis") echo "selected"; ?>>Jenis Buku</option>
        </select>
        <input type="text" size="50" id="keyword" name="keyword" placeholder="Cari data yang diinginkan" autocomplete="off">
        <img src="img/load.gif" alt="" class="loading">
        <button type="submit" id="cetak">Cetak</button>
        <button type="reset" id="reset"><a href="index.php">Reset</a></button>
    </form>
    <br><br>



    <div id="container">


    </div>

    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/script.js?v=1.0.1"></script>
</body>

</html>