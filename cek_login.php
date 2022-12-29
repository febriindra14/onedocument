<?php
//aktifkan session pd php
session_start();
include 'config.php';

// menangkap data yang dikirim dari form login (escape string : keamanan hack)
$user = mysqli_escape_string($koneksi, $_POST['username']);
$pass = md5($_POST['password']);
$password = mysqli_escape_string($koneksi, $pass);
$cek_user = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$user' && password = '$password' ");
$user_valid = mysqli_num_rows($cek_user);

if ($user_valid > 0) {
    $data = mysqli_fetch_assoc($cek_user);
    if ($data['level'] == "administrator") {
        //tampung di session
        $_SESSION['username'] = $user;
        $_SESSION['level'] = "administrator";
        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['foto'] = $data['foto'];
        header('location:administrator/index.php');
    } elseif ($data['level'] == "user") {
        $_SESSION['username'] = $user;
        $_SESSION['level'] = "user";
        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['nama'] = $data['nama'];
        $_SESSION['foto'] = $data['foto'];
        header('location:user/index.php');
    } else {
        echo "<script>alert('Maaf, Login gagal');document.location='index.php'</script>";
    }
} else {
    echo "<script>alert('Maaf, Login gagal, username atau password tidak ada!');document.location='index.php'</script>";
}
