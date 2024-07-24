<?php
session_start();
require 'functions.php';
if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

;
$id = $_GET["id"];


$buku = query("SELECT * FROM buku WHERE id = '$id'")[0];

if (isset($_POST["submit"])) {
    $gambarLama = $buku["gambar"];
    

    if (ubah($_POST, $id,  $gambarLama) > 0) {
        echo
        "<script>
        alert('Data berhasil diedit!');
        document.location.href = 'index.php';
        </script>";
        
    } else {
        echo 
        "<script>
        alert('Data gagal diedit!');
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
    <title>Edit Data</title>
</head>
<body>
    <h1>Edit Data</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="buku">Nama Buku:</label>
                <input type="text" name="buku" id="buku" value="<?= $buku["nama"]; ?>" required>
            </li>
            <li>
                <label for="tahun">Tahun Terbit:</label>
                <input type="text" name="tahun" id="tahun" value="<?= $buku["tahunTerbit"]; ?>" required>
            </li>
            <li>
                <label for="">Jenis Buku: </label>
                <input type="radio" name="jenis" id="manga" value="Manga" <?= ($buku["jenis"]=="Manga")?'checked':'' ; ?> required>
                <label for="manga">Manga</label>
                <input type="radio" name="jenis" id="manhwa" value="Manhwa" <?= ($buku["jenis"]=="Manhwa")?'checked':'' ; ?> required>
                <label for="manhwa">Manhwa</label>
                <input type="radio" name="jenis" id="ln" value="Light Novel" <?= ($buku["jenis"]=="Light Novel")?'checked':'' ; ?> required>
                <label for="ln">Light Novel</label>
            </li>
            <li>
                <label for="gambar">Gambar:</label>
                <img src="img/<?= $buku["gambar"]; ?>" width="100" alt=""><br>
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <input type="submit" value="Edit" name="submit">
            </li>
        </ul>
    </form>
    
</body>
</html>