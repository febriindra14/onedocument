<?php

session_start();
include 'config.php';

// menangkap data yang dikirim dari form login 
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
        //echo "<script>alert('Maaf, Login gagal');document.location='index.php'</script>";
        header('location:index.php?pesan=gagal');
    }
} else {
    //echo "<script>alert('Maaf, Login gagal, username atau password tidak ada!');document.location='index.php'</script>";
    header('location: index.php?pesan=failed');
};

//add user
if (isset($_POST['userad'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repass = $_POST['repassword'];
    $level = $_POST['level'];
    $nama = $_POST['nama'];
    $nidn = $_POST['nidn'];
    $prodi = $_POST['prodi'];
    $jafung = $_POST['jafung'];
    $wa = $_POST['no_wa'];
    $tgl_lahir = $_POST['tgl_lahir'];

    if (isset($_FILES['foto']['name'])) {
        $file_name = $_FILES['foto']['name'];
        if (empty($file_name)) {
            $koneksi->query("INSERT INTO user(id_user,username,email,password,repassword,level,nama,nidn,prodi,jafung,no_wa,tgl_lahir) VALUES(NULL,'$username','$email', md5('$password'),'$repass','$level','$nama','$nidn','$prodi','$jafung','$wa','$tgl_lahir')");
            header('location: index.php?pesan=succes');
        } else {
            $file_tmp = $_FILES['foto']['tmp_name'];
            move_uploaded_file($file_tmp, "img/" . $file_name);
            $koneksi->query("INSERT INTO user(id_user,username,email,password,repassword,level,nama,nidn,prodi,jafung,no_wa,tgl_lahir,foto) VALUES(NULL,'$username','$email', md5('$password'),'$repass','$level','$nama','$nidn','$prodi','$jafung','$wa','$tgl_lahir','$file_name')");
            header('location: index.php?pesan=succes');
        }
    } else {
        /*echo "<div class='alert alert-warning'>
        <strong>MAAF GAGAL</strong>
      </div>"; */
        header('location: index.php?pesan=warning');
    }
}
