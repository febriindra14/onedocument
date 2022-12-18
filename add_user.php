<!-- add user -->
<?php
include 'config.php';
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$level = $_POST['level'];
$nama = $_POST['nama'];
$nidn = $_POST['nidn'];
$prodi = $_POST['prodi'];
$jafung = $_POST['jafung'];
$wa = $_POST['no_wa'];
$tgl_lahir = $_POST['tgl_lahir'];
$foto = $_POST['foto'];

$query = mysqli_query($koneksi, "INSERT INTO user VALUES(NULL,'$username','$email', md5('$password'),'$level','$nama','$nidn','$prodi','$jafung','$wa','$tgl_lahir','$foto')");
if ($query) {
  echo " <div class='alert alert-success'>
    <strong>Success!</strong>
  </div>
<meta http-equiv='refresh' content='1; url= index.php'/>  ";
} else {
  echo "<div class='alert alert-warning'>
    <strong>Failed!</strong>
  </div>
 <meta http-equiv='refresh' content='1; url= index.php'/> ";
}
?>