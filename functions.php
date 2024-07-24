<?php
    $connect = mysqli_connect("localhost", "root", "", "phpdasar2");

   function query($query) {
    global $connect;
    $result = mysqli_query($connect, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
   }

   function upload() {
     $namaFile = $_FILES["gambar"]["name"];
     $sizeFile = $_FILES["gambar"]["size"];
     $error= $_FILES["gambar"]["error"];
     $temporary =$_FILES["gambar"]["tmp_name"];

     // Pake required dihtml inputnya juga bisa untuk di file tambah
     // Ralat, misalnya pakai required, nanti di file edit mengharuskan menginput gambar
     if ($error===4) {
          echo
          "<script>
          alert('Pilih gambar!');
          </script>";
          return false;
     }

     $validExt = ["jpg", "png", "jpeg", "webp"];
     // $extGambar =  strtolower(end(explode('.' , $namaFile))); Ini ga error tapi  warning

     // $extGambar = explode('.', $namaFile);
     // $extGambar = strtolower(end($extGambar));

     // cara terbaru menggunakan function pathinfo dari php itu sendiri
     $extGambar =  pathinfo($namaFile, PATHINFO_EXTENSION); 
     
     if (!in_array($extGambar, $validExt)) {
          echo
          "<script>
          alert('Gambar yang diupload salah! Silahkan upload file berextensi jpg,png, atau jpeg');
          </script>";
          return false;
     }
     
     if ($sizeFile>1000000) {
          echo
          "<script>
          alert('Size gambar terlalu besar!');
          </script>";
          return false;
     }

     $namaFileBaru = uniqid("buku"). '.' .$extGambar;
    
     

     move_uploaded_file($temporary, 'img/'. $namaFileBaru);
     return $namaFileBaru;

   }


   function tambah($data) {
        global $connect;
        $buku = htmlspecialchars($data["buku"]);
        $tahun = htmlspecialchars($data["tahun"]);
        $jenis = htmlspecialchars($data["jenis"]);

        $gambar = upload();
        if (!$gambar) {
          return false;     
        }
        

        mysqli_query($connect, "INSERT INTO buku VALUES ('','$buku','$tahun','$jenis','$gambar')");

        return mysqli_affected_rows($connect);
   }

   function hapus($id) {
        global $connect;
        mysqli_query($connect, "DELETE FROM buku WHERE id = '$id'");

        return mysqli_affected_rows($connect);
   }

   function ubah($data, $id, $gambarLama) {
     global $connect;
     $buku = htmlspecialchars($data["buku"]);
     $tahun = htmlspecialchars($data["tahun"]);
     $jenis = htmlspecialchars($data["jenis"]);


     if ($_FILES["gambar"]["error"]===4) {
          $gambar = $gambarLama;
     }  else {
          $gambar = upload();
     }
     

     mysqli_query($connect, "UPDATE buku SET nama = '$buku', tahunTerbit = '$tahun', jenis = '$jenis', gambar='$gambar' WHERE id = '$id'");

     return mysqli_affected_rows($connect);
     }


     function cari($keyword, $kolom, $awalData, $jumlahDataPerHalaman) {
               return query("SELECT * FROM buku WHERE $kolom LIKE '%$keyword%' LIMIT $awalData, $jumlahDataPerHalaman" );
         
     }

     function register($data) {
          global $connect;

          $username = strtolower(stripslashes($data["username"]));
          $password = mysqli_real_escape_string($connect,$data["password"]);
          $password2 = mysqli_real_escape_string($connect, $data["password2"]);

          $isUsernameAvailable= mysqli_query($connect, "SELECT username FROM users WHERE username = '$username'");
          if ( mysqli_fetch_assoc($isUsernameAvailable)) {
               echo
               "<script>
               alert('Username sudah ada! Silahkan pilih username lain!');
               </script>";
               return false;
          }

          if ($password != $password2) {
               echo
               "<script>
               alert('Konfirmasi Password salah!');
               </script>";
               return false;
          }
          $password =  password_hash($password, PASSWORD_DEFAULT);

          mysqli_query($connect, "INSERT INTO users VALUES('','$username','$password')");

          return mysqli_affected_rows($connect);
     }
?>