<?php
session_start();

if ($_SESSION['level'] == "") {
    header('location:../index.php');
}
$page = "userq";
?>
<!DOCTYPE html>
<html lang="en">
<?php
include '../config.php';

if (isset($_POST['update'])) {
    $iduser = $_POST['id_user'];
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

    $gambar = $_FILES['foto']['name'];
    if (empty($gambar)) {
        $koneksi->query("UPDATE user SET username='$username', email='$email', password=md5('$password'), repassword='$repass', level='$level', nama='$nama', nidn='$nidn', prodi='$prodi', jafung='$jafung', no_wa='$wa', tgl_lahir='$tgl_lahir' where id_user=$iduser ");
        header('location: profil.php?pesan=succes');
    } else {
        $hapus = $koneksi->query("SELECT * FROM user WHERE id_user=$iduser");
        $nama_gambar = mysqli_fetch_array($hapus);
        $lokasi = $nama_gambar['foto'];
        $hapus_gambar = "../img/" . $lokasi;
        //hapus foto dari folder
        unlink($hapus_gambar);
        //add folder lagi
        move_uploaded_file($_FILES['foto']['tmp_name'], "../img/" . $gambar);
        $koneksi->query("UPDATE user SET username='$username', email='$email', password=md5('$password'), repassword='$repass', level='$level', nama='$nama', nidn='$nidn', prodi='$prodi', jafung='$jafung', no_wa='$wa', tgl_lahir='$tgl_lahir', foto='$gambar' where id_user=$iduser ");
        header('location: profil.php?pesan=succes');
    }
};

?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../img/unuyo.png" type="">
    <title>One document - Profil</title>
    <?php include('../layout/header.php'); ?>
    <style>
        a,
        a:hover {
            color: #333
        }

        /* menu actv */
        li.active {
            background-color: #464646;
        }

        /*profil */
        .fp {
            width: 200px;
            height: 180px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->

        <?php include('sidebar_user.php'); ?>

        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->

                <?php include('../layout/topbar.php'); ?>

                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <!--<h1 class="h3 mb-0 text-gray-800">User</h1> -->
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>

                    <!-- Content Row 
                    <div class="row">

                    </div> -->

                    <?php
                    if (isset($_GET['pesan'])) {
                        if ($_GET['pesan'] == "succes") {
                            echo " <div class='alert alert-success'>
                                    <strong>Berhasil ubah data</strong>
                                    </div>
                                    <meta http-equiv='refresh' content='1; url= profil.php'/>  ";
                        } else {
                            echo "<div class='alert alert-warning'>
                                    <strong>Gagal ubah data</strong>
                                     </div>
                                 <meta http-equiv='refresh' content='1; url= profil.php'/> ";
                        }
                    }
                    ?>

                    <?php
                    $user = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$_SESSION[id_user]' ");
                    while ($f = mysqli_fetch_array($user)) {
                        $id_user = $f['id_user'];
                    ?>

                        <td><button class="btn btn-warning" data-toggle="modal" data-target="#edit<?= $id_user; ?>"><i class="fa fa-pen"></i> Edit </button> </td> <br /><br />

                        <div class="row">

                            <div class="col-lg-5">

                                <!-- Basic Card Example -->
                                <div class="card shadow mb-4">
                                    <!--<div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Foto</h6>
                                    </div> -->
                                    <div class="card-body">
                                        <div class="form-group">
                                            <td>Foto profil</td>
                                            <td>:</td>
                                            <img class="fp" src='../img/<?= $_SESSION['foto']  ?>'>
                                        </div>
                                        <div class="form-group">
                                            <td style="text-align: center;">Username</td>
                                            <td>:</td>
                                            <td><?php echo $f['username'] ?></td>
                                        </div>
                                        <div class="form-group">
                                            <td>Email</td>
                                            <td>:</td>
                                            <td><?php echo $f['email'] ?></td>
                                        </div>
                                        <div class="form-group">
                                            <td>Password</td>
                                            <td>:</td>
                                            <td><?php echo $f['repassword'] ?></td>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-7">

                                <!-- Basic Card Example -->
                                <div class="card shadow mb-4">
                                    <!--<div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Datanya</h6>
                                    </div> -->
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="">Nama</label>
                                            <td>:</td>
                                            <td><?php echo $f['nama'] ?></td>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nomor induk dosen nasional</label>
                                            <td>:</td>
                                            <td><?php echo $f['nidn'] ?></td>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Prodi</label>
                                            <td>:</td>
                                            <td><?php echo $f['prodi'] ?></td>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Jabatan fungsional</label>
                                            <td>:</td>
                                            <td><?php echo $f['jafung'] ?></td>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Nomor WhatsApp</label>
                                            <td>:</td>
                                            <td><?php echo $f['no_wa'] ?></td>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Tanggal lahir</label>
                                            <td>:</td>
                                            <td><?php echo $f['tgl_lahir'] ?></td>
                                        </div>
                                    </div>

                                    </td>
                                </div>
                            </div>


                            <!-- The Modal -->
                            <div class="modal fade" id="edit<?= $id_user; ?>">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="post" enctype="multipart/form-data">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit user</h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">

                                                <div class="form-group">
                                                    <label for="username">Username</label>
                                                    <input type="text" id="username" name="username" class="form-control" value="<?php echo $f['username'] ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" id="email" name="email" class="form-control" value="<?php echo $f['email'] ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label for="">Password</label>
                                                    <div class="input-group" id="show_hide_password">
                                                        <input type="password" name="password" class="form-control" value="<?php echo $f['password'] ?>">
                                                        <div class=" input-group-append">
                                                            <span class="input-group-text">
                                                                <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <i style="font-size:13px; color:red;">* Harap di isi jika ganti password</i>
                                                </div>

                                                <div class="form-group">
                                                    <label for="password">Ulangi Password</label>
                                                    <div class="input-group" id="show_hide_password">
                                                        <input type="password" name="repassword" class="form-control" value="<?php echo $f['repassword'] ?>">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">
                                                                <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <i style="font-size:13px; color:red;">* Harap di isi jika ganti password</i>
                                                </div>

                                                <input type="hidden" name="level" class="form-control" value="<?php echo $f['level'] ?>">

                                                <div class="form-group">
                                                    <label for="nama">Nama</label>
                                                    <input type="text" id="nama" name="nama" class="form-control" value="<?php echo $f['nama'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="nidn">Nomor induk dosen nasional</label>
                                                    <input type="text" id="nidn" name="nidn" class="form-control" value="<?php echo $f['nidn'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Prodi</label>
                                                    <select name="prodi" class="custom-select form-control">
                                                        <option value="<?= $f['prodi'] ?>"><?= $f['prodi'] ?></option>
                                                        <option value="informatika">Informatika</option>
                                                        <option value="teknik komputer">Teknik komputer</option>
                                                        <option value="teknik elektro">Teknik elektro</option>
                                                        <option value="akuntansi">Akuntansi</option>
                                                        <option value="manajemen">Manajemen</option>
                                                        <option value="pendidikan bahasa inggris">Pbi</option>
                                                        <option value="pendidikan guru sekolah dasar">Pgsd</option>
                                                        <option value="agribisnis">Agribisnis</option>
                                                        <option value="teknologi hasil pertanian">Thp</option>
                                                        <option value="farmasi">Farmasi</option>
                                                        <option value="studi islam interdisipliner">Sii</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Jabatan Fungsional</label>
                                                    <select name="jafung" class="custom-select form-control" required>
                                                        <option value="<?= $f['jafung'] ?>"><?= $f['jafung'] ?></option>
                                                        <option value="aa">AA</option>
                                                        <option value="lektor">Lektor</option>
                                                        <option value="guru besar">Guru Besar</option>
                                                        <option value="belum">Belum</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="whatsapp">WhatsApp</label>
                                                    <input type="text" id="whatsapp" name="no_wa" class="form-control" value="<?php echo $f['no_wa'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="tl">Tanggal lahir</label>
                                                    <input type="date" id="tl" name="tgl_lahir" class="form-control" value="<?php echo $f['tgl_lahir'] ?>">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="file" class="font-weight-bold text-primary">Foto</label>
                                                    <input type="file" class="form-control-file" id="file" name="foto" accept=".jpg , .png , .jpeg">
                                                </div>
                                                <div class="mb-3">
                                                    <img src='../img/<?= $f['foto'] ?>' class='img-thumbnail' id='myImg'>
                                                </div>

                                                <input type="hidden" name="id_user" value="<?= $id_user; ?>">

                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success" name="update">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        <?php
                    } ?>
                        </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include('../layout/footer.php'); ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- javascript -->
    <?php include('../layout/down.php'); ?>
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("fa-eye-slash");
                    $('#show_hide_password i').removeClass("fa-eye");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("fa-eye-slash");
                    $('#show_hide_password i').addClass("fa-eye");
                }
            });
        });
    </script>

</body>

</html>