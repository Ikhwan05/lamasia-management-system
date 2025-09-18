<?php 
session_start();
require "functions.php";


if( isset($_COOKIE["id"]) && isset($_COOKIE["key"]) ) {

    $id = $_COOKIE["id"];
    $key = $_COOKIE["key"];

    // ambil username berdasarkan id
    $result = mysqli_query($db, "SELECT username FROM users WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    // cek apakah id dan username sama dengan yg ada di database
    if ( hash('sha256', $row["username"]) === $key ) {
        $_SESSION["login"] = true;
    }

}



if( isset($_SESSION["login"]) ) {
    header("Location: index.php");

}



if ( isset($_POST["login"]) ){

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'");

    // cek usernamenya sama atau tidak
    if ( mysqli_num_rows($result) === 1 ) {

        // cek passwordnya
        $row = mysqli_fetch_assoc($result);

        if ( password_verify($password, $row["password"]) ) {

            // buat sessionnya
            $_SESSION["login"] = true;

            // cek sudah di ceklis atau belum
            if( isset($_POST["remember"]) ) {

                // buat cookie
                setcookie('id', $row["id"], time() + 120);
                setcookie('key', hash('sha256', $row["username"]), time() + 120);

            }

            header("Location: index.php");
        }

    }

    $error = true;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php if(isset($error)) : ?>
        <p style="color: red; font-style: italic;">username/password salah</p>
        <?php endif ?>

    <form action="" method="post">
        <ul>
            <li>
                <label for="username">Username : </label>
                <input type="text" id="username" name="username">
            </li>
            <li>
                <label for="password">Password : </label>
                <input type="password" id="password" name="password">
            </li>
            <li>
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember Me</label>
            </li>
            <li>
                <button type="submit" name="login">Login</button>
            </li>
        </ul>

    </form>
</body>
</html>