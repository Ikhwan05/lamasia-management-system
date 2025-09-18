<?php 

require "functions.php";

if( isset($_POST["regis"]) ) {

    if(regis($_POST) > 0) {
        echo "<script>alert('user baru telah ditambahkan')</script>";
    } else {
        echo mysqli_error($db);
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
    
<form action="" method="post">
    <ul>
        <li>
            <label for="username">username :</label>
            <input type="text" id="username" name="username">
        </li>
        <li>
            <label for="password">password :</label>
            <input type="password" id="password" name="password">
        </li>
        <li>
            <label for="password2">konfirmasi password :</label>
            <input type="password" id="password2" name="password2">
        </li>
        <li>
            <button type="submit" name="regis">Registrasi</button>
        </li>
    </ul>
</form>

</body>
</html>