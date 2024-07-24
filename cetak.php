<?php

require_once __DIR__ . '/vendor/autoload.php';
require 'functions.php';
$keyword = (isset($_GET["keyword"])) ? $_GET['keyword'] : "";
$kolom = (isset($_GET["Kolom"])) ? $_GET['Kolom'] : "nama";

$buku = query("SELECT * FROM buku WHERE $kolom LIKE '%$keyword%'");

$mpdf = new \Mpdf\Mpdf();
$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku</title>
</head>
<body>
    <h1>Daftar Buku</h1>
    <table border="1" cellpaddding="10" cellspacing="0" >
        <tr>
            <th>No.</th>
            <th>Nama Buku</th>
            <th>Tahun Terbit</th>
            <th>Jenis Buku</th>
            <th>Gambar</th>
        </tr>';

        $i = 1;
        foreach ($buku as $e) {
            $html .= '<tr>
                <td>'.$i.'</td>
                <td>'.$e["nama"].'</td>
                <td>'.$e["tahunTerbit"].'</td>
                <td>'.$e["jenis"].'</td>
                <td><img src="img/'.$e["gambar"].'" width="250px"></td>
            </tr>';
            $i++;
        }

$html .='</table>
</body>
</html>';
$mpdf->WriteHTML($html);
$mpdf->Output("Daftar Buku.pdf", "I");

?>
