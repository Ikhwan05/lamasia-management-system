<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require "functions.php";

$lamasia = query("SELECT * FROM lamasia");

if ( isset($_POST["cari"]) ) {

    $lamasia = cari($_POST["keyword"]);

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="js/jquery-3.7.1.js"></script>

    <style>
        #loader {
            width: 120px;
            position: absolute;
            z-index: -1;
            top: 85px;
            left: 280px;
            display: none;
        }
    </style>

</head>
<body>
    <h1>Daftar Lulusan Terbaik LaMasia</h1>
    <a href="tambah.php">Tambahkan lulusan laMasia</a>
    <br><br>

    <form action="" method="post">
        <input type="text" name="keyword" autofocus autocomplete="off" size="40" id="keyword">
        <button type="submit" name="cari" id="button">Cari</button>
        <img src="img/Loading_icon.gif" id="loader">
    </form>
    <br>

    <div id="container">
        <table border="1" cellspacing="0" cellpadding="10">
        <tr>
            <th>No.</th>
            <th>Aksi</th>
            <th>Gambar</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Kaki Dominan</th>

        </tr>
        <?php $count = 1 ?>
        <?php foreach( $lamasia as $lamas ) : ?>
            <tr>
            <td><?= $count ?></td>
            <td>
                <a href="edit.php?id=<?= $lamas["id"] ?>">Edit</a> | 
                <a href="hapus.php?id=<?= $lamas["id"] ?>" onclick="confirm('yakin mau hapus data ini?')">Hapus</a>
            </td>
            <td><img src="img/<?= $lamas["gambar"] ?>" alt="" width="50"></td>
            <td><?= $lamas["nama"] ?></td>
            <td><?= $lamas["email"] ?></td>
            <td><?= $lamas["kakiTerkuat"] ?></td>
        </tr>
        <?php $count++ ?>
        <?php endforeach ?>
    </table>
    </div>
    

    <a href="logout.php">Logout</a>


    <script src="js/script.js"></script>
</body>
</html>