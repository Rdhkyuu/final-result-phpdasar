<?php
    require 'functions.php';

    if (isset($_POST["register"]) > 0) {

        if (register($_POST) > 0) {
            echo
            "<script>
            alert('User berhasil ditambahkan!');
            document.location.href = 'index.php';
            </script>";
            
        } else {
            echo mysqli_error($connect);
        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <style>
        label {
            display: block;
        }
    </style>
</head>
<body>
    <h1>
        Halaman Registrasi
    </h1>
    <a href="login.php">Sudah punya akun?</a>

    <form action="" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        
        <label for="password2">Confirm Password:</label>
        <input type="password" name="password2" id="password2" required>

        <br>
        <br>
        <button type="submit" name="register">Register</button>
    </form>
</body>
</html>