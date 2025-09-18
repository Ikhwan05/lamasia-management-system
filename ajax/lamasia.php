<?php
sleep(1); 
require "../functions.php";

$keyword = $_GET["keyword"];

$query = "SELECT * FROM lamasia WHERE nama LIKE '%$keyword%' OR kebangsaan LIKE '%$keyword%' OR kakiTerkuat LIKE '%$keyword%' OR email LIKE '%$keyword%'";
$lamasia = query($query);

?>

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