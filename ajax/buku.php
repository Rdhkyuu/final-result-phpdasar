<?php
    require '../functions.php';
    $kolom = (isset($_GET["Kolom"]))? $_GET["Kolom"] : "nama";
    $keyword = (isset($_GET["keyword"]))? $_GET["keyword"] : "";
    $jumlahDataPerHalaman = 2;
    $hal =  (isset($_GET["page"])) ? $_GET["page"] : 1;
    $awalData = ($hal - 1) * $jumlahDataPerHalaman;
    $jumlahData = count(query("SELECT * FROM buku WHERE $kolom LIKE '%$keyword%'"));
    $jumlahHalaman = ceil($jumlahData/$jumlahDataPerHalaman);
    $buku = cari($keyword, $kolom, $awalData, $jumlahDataPerHalaman);
    
?>

 <?php if($hal>1):  ?>
    <?php if(isset($_GET["keyword"]) && $_GET["keyword"] != "" && isset($_GET["Kolom"]) && $_GET["Kolom"] != "") :?>
        <?php $link_prev = $hal - 1;?>
        <a class="halaman" id="<?= $link_prev; ?>" href="#">&laquo;</a>
    <?php else: ?>
        <?php $link_prev = $hal - 1;?>
        <a class="halaman" id="<?= $link_prev; ?>"  href="#">&laquo;</a>
    <?php endif; ?>
<?php endif;?>

<?php for ($i=1; $i <= $jumlahHalaman; $i++) : ?>
    <?php if(isset($_GET["keyword"]) && $_GET["keyword"] != "" && isset($_GET["Kolom"]) && $_GET["Kolom"] != "") :?>

        <?php if($i == $hal):?>
        <a class="halaman" id="<?= $i;?>"  href="#" style="font-weight: bold; color: red; font-size: 20px;"><?= $i;?></a>
        <?php else: ?>
        <a class="halaman" id="<?= $i;?>" href="#"><?= $i;?></a>
        <?php endif; ?>

    <?php else: ?>
        <?php if($i == $hal):?>
        <a class="halaman" id="<?= $i;?>" href="#" style="font-weight: bold; color: red; font-size: 20px;"><?= $i;?></a>
        <?php else: ?>
        <a class="halaman" id="<?= $i;?>" href="#"><?= $i;?></a>
        <?php endif; ?>

    <?php endif; ?>
<?php endfor; ?>

<?php if($hal < $jumlahHalaman):  ?>
    <?php if(isset($_GET["keyword"]) && $_GET["keyword"] != "" && isset($_GET["Kolom"]) && $_GET["Kolom"] != "") :?>
        <?php $link_selanjutnya = $hal + 1;?>
        <a class="halaman" id="<?= $link_selanjutnya; ?>" href="#">&raquo;</a>
    <?php else: ?>
        <?php $link_selanjutnya = $hal + 1;?>
        <a class="halaman" href="#" id="<?= $link_selanjutnya; ?>">&raquo;</a>
    <?php endif; ?>
<?php endif;?>


<table border="1" cellpaddding="10" cellspacing="0" >
            <tr>

                <th>No.</th>
                <th>Nama Buku</th>
                <th>Tahun Terbit</th>
                <th>Jenis Buku</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
                
            <?php
                $no = $awalData + 1;
                foreach ($buku as $e) :
            ?>
            <tr>
                <td><?= $no; ?></td>
                <td><?= $e["nama"]; ?></td>
                <td><?= $e["tahunTerbit"]; ?></td>
                <td><?= $e["jenis"]; ?></td>
                <td><img src="img/<?= $e["gambar"]; ?>" width="250" alt=""></td>
                <td>
                    <a href="hapus.php?id=<?= $e['id']; ?>" onclick="return confirm('Konfirmasi?')">Hapus</a>
                    <a href="ubah.php?id=<?= $e['id']; ?>">Edit</a>
                </td>
            </tr>
            <?php
                $no++;
                endforeach; 
            ?>
        </table>