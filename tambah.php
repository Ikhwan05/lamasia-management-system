<?php 
session_start();

if(!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}

require "functions.php";

if( isset($_POST["submit"]) ) {

    if( tambah($_POST) > 0 ) {
        echo "<script>
        alert('data berhasil ditambahkan')
        document.location.href = 'index.php'
        </script>";
    } else {
        echo "<script>
        alert('data gagal ditambahkan')
        document.location.href = 'index.php'
        </script>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Tambah lulusan laMasia</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="nama">Nama : </label>
                <input type="text" id="nama" name="nama" required>

            </li>
            <li>
                <label for="kebangsaan">Kebangsaan : </label>
                <input type="text" id="kebangsaan" name="kebangsaan" required>
            </li>
            <li>
                <label for="kakiTerkuat">Kaki Dominan : </label>
                <input type="text" name="kakiTerkuat" id="kakiTerkuat" required>
            </li>
            <li>
                <label for="email">Email : </label>
                <input type="text" name="email" id="email" required>
            </li>
            <li>
                <label for="gambar">Gambar : </label>
                <input type="file" id="gambar" name="gambar" required>
            </li>
            <li>
                <button type="submit" name="submit">Tambah</button>
            </li>
        </ul>
    </form>
</body>
</html>