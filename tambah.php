<?php
session_start();
require 'functions.php';
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}



if (isset($_POST["submit"])) {
    
    if (tambah($_POST) > 0) {
        echo
        "<script>
        alert('Data berhasil ditambahkan!');
        document.location.href = 'index.php';
        </script>";
        
    } else {
        echo 
        "<script>
        alert('Data gagal ditambahkan!');
        document.location.href = 'index.php';
        </script>";
    }

} 

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
</head>
<body>
    <h1>Tambah Data</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="buku">Nama Buku:</label>
                <input type="text" name="buku" id="buku" required>
            </li>
            <li>
                <label for="tahun">Tahun Terbit:</label>
                <input type="text" name="tahun" id="tahun" required>
            </li>
            <li>
                <label for="">Jenis Buku: </label>
                <input type="radio" name="jenis" id="manga" value="Manga" required>
                <label for="manga">Manga</label>
                <input type="radio" name="jenis" id="manhwa" value="Manhwa" required>
                <label for="manhwa">Manhwa</label>
                <input type="radio" name="jenis" id="ln" value="Light Novel" required>
                <label for="ln">Light Novel</label>
            </li>
            <li>
                <label for="gambar">Gambar:</label>
                <input type="file" name="gambar" id="gambar" required >
            </li>
            <li>
                <input type="submit" value="Kirim" name="submit">
            </li>
        </ul>
    </form>
    
</body>
</html>