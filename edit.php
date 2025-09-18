<?php 
session_start();

if(!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}


require "functions.php";

$id = $_GET["id"];

$lamasia = query("SELECT * FROM lamasia WHERE id = $id")[0];



if( isset($_POST["submit"]) ) {

    if( edit($_POST) > 0 ) {
        echo "<script>
        alert('data berhasil diubah')
        document.location.href = 'index.php'
        </script>";
    } else {
        echo "<script>
        alert('data gagal diubah')
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
    <h1>Edit lulusan laMasia</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $lamasia["$id"] ?>">
        <input type="hidden" name="gambarLama" value="<?= $lamasia["gambar"] ?>">
        <ul>
            <li>
                <label for="nama">Nama : </label>
                <input type="text" id="nama" name="nama" required value="<?= $lamasia["nama"] ?>">
            </li>
            <li>
                <label for="kebangsaan">Kebangsaan : </label>
                <input type="text" id="kebangsaan" name="kebangsaan" required value="<?= $lamasia["kebangsaan"] ?>">
            </li>
            <li>
                <label for="kakiTerkuat">Kaki Dominan : </label>
                <input type="text" name="kakiTerkuat" id="kakiTerkuat" required value="<?= $lamasia["kakiTerkuat"] ?>">
            </li>
            <li>
                <label for="email">Email : </label>
                <input type="text" name="email" id="email" required value="<?= $lamasia["email"] ?>">
            </li>
            <li>
                <label for="gambar">Gambar : </label><br>
                <img src="img/<?= $lamasia["gambar"] ?>" alt="" width="50"><br>
                <input type="file" id="gambar" name="gambarLama">
            </li>
            <li>
                <button type="submit" name="submit">Ubah</button>
            </li>
        </ul>
    </form>
</body>
</html>