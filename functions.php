<?php 
// koneksi ke database
$db = mysqli_connect("localhost", "root", "", "phpdasar");


function query($query) {
    global $db;
    $result = mysqli_query($db, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ){
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data) {
    global $db;
    
    $nama = htmlspecialchars($data["nama"]);
    $kebangsaan = htmlspecialchars($data["kebangsaan"]);
    $kakiTerkuat = htmlspecialchars($data["kakiTerkuat"]);
    $email = htmlspecialchars($data["email"]);
    
    $gambar = upload();
    if ( !$gambar ) {
        return false;
    }


    $query = "INSERT INTO lamasia (nama, kebangsaan, kakiTerkuat, email, gambar) VALUES ('$nama', '$kebangsaan', '$kakiTerkuat', '$email', '$gambar')";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}


function upload() {

    $namaFile = $_FILES["gambar"]["name"];
    $ukuranFile = $_FILES["gambar"]["size"];
    $error = $_FILES["gambar"]["error"];
    $tmpName = $_FILES["gambar"]["tmp_name"];

    // cek apakah sudah upload atau belum
    if( $error === 4 ) {
        echo '<script>
        alert("upload gambar telebih dahulu")
        </script>';

        return false;
    }


    // tentukan yang boleh di upload hanya gambar
    $ekstensiGambarValid = ["jpg", "png", "jpeg"];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
        echo '<script>
        alert("yang anda upload bukan gambar")
        </script>';

        return false;
    }


    // tentukan batas ukuran file yang boleh di upload
    if( $ukuranFile > 2000000 ) {
        echo '<script>
        alert("ukuran foto melebihi 2MB")
        </script>';

        return false;
    }

    // bikin nama file baru (antisipasi supaya tidak ada nama file yang sama)
    $namaFileBaru = uniqid();
    $namaFileBaru .= ".";
    $namaFileBaru .= $ekstensiGambar;

    // lolos dari pengecekan, ambil dari tmp_name ke direktori
    move_uploaded_file($tmpName, "img/" . $namaFileBaru);

    return $namaFileBaru;


}



function hapus($id) {
    global $db;

    $query = "DELETE FROM lamasia WHERE id =  $id";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

function edit($data) {
    global $db;
    
    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $kebangsaan = htmlspecialchars($data["kebangsaan"]);
    $kakiTerkuat = htmlspecialchars($data["kakiTerkuat"]);
    $email = htmlspecialchars($data["email"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    if ( $_FILES["gambar"]["error"] === 4 ){
        $gambar = $gambarLama;
    } else {
        $gambar = upload();

    }



    $query = "UPDATE lamasia SET nama ='$nama', kebangsaan = '$kebangsaan', kakiTerkuat = '$kakiTerkuat', email = '$email', gambar = '$gambar' WHERE id = $id";
    mysqli_query($db, $query);

    return mysqli_affected_rows($db);

}


function cari($keyword) {

    $query = "SELECT * FROM lamasia WHERE nama LIKE '%$keyword%' OR kebangsaan LIKE '%$keyword%' OR kakiTerkuat LIKE '%$keyword%' OR email LIKE '%$keyword%'";
    
    return query($query);

}


function regis($data) {
    global $db;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($db, $data["password"]);
    $password2 = mysqli_real_escape_string($db, $data["password2"]);

    // cek username sudah ada atau belum
    $result = mysqli_query($db, "SELECT username FROM users WHERE username = '$username'");

    if( mysqli_fetch_assoc($result) ) {
        echo "<script>alert('username sudah terdaftar, silahkan gunakan username yg lain')</script>";
        return false;
    }

    // cek konfirmasi password
    if( $password !== $password2 ) {
        echo "<script>alert('konfirmasi password tidak sesuai')</script>";
        return false;
    } 
    
    // enskripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);


    // tambahkan user baru ke database
    mysqli_query($db, "INSERT INTO users (username, password) VALUES ('$username', '$password')");

    return mysqli_affected_rows($db);
}


?>