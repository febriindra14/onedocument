<!-- add user -->
<?php
include 'config.php';
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
    echo " <div class='alert alert-success'>
    <strong>Success!</strong>
  </div>
<meta http-equiv='refresh' content='1; url= index.php'/>  ";
  } else {
    $file_tmp = $_FILES['foto']['tmp_name'];
    move_uploaded_file($file_tmp, "img/" . $file_name);
    $koneksi->query("INSERT INTO user(id_user,username,email,password,repassword,level,nama,nidn,prodi,jafung,no_wa,tgl_lahir,foto) VALUES(NULL,'$username','$email', md5('$password'),'$repass','$level','$nama','$nidn','$prodi','$jafung','$wa','$tgl_lahir','$file_name')");
    echo " <div class='alert alert-success'>
    <strong>Success dengan foto</strong>
  </div>
<meta http-equiv='refresh' content='1; url= index.php'/>  ";
  }
} else {
  echo "<div class='alert alert-warning'>
    <strong>MAAF GAGAL</strong>
  </div>";
}

?>