<?php
session_start();

if ($_SESSION['level'] == "") {
    header('location:../index.php');
}
$page = "user";
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

if (isset($_POST['hapus'])) {
    $id_user = $_POST['id_user'];

    $hapus = $koneksi->query("SELECT * FROM user WHERE id_user=$id_user");
    $nama_gambar = mysqli_fetch_array($hapus);
    $lokasi = $nama_gambar['foto'];
    $hapus_gambar = "../img/" . $lokasi;
    unlink($hapus_gambar);

    $delete = mysqli_query($koneksi, "DELETE FROM user where id_user='$id_user'");
    //cek apakah berhasil
    if ($delete) {
        header('location: profil.php?pesan=succesd');
    } else {
        header('location: profil.php?pesan=failedd');
    }
};

if (isset($_POST['simpan'])) {
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
            header('location: profil.php?pesan=success');
        } else {
            $file_tmp = $_FILES['foto']['tmp_name'];
            move_uploaded_file($file_tmp, "../img/" . $file_name);
            $koneksi->query("INSERT INTO user(id_user,username,email,password,repassword,level,nama,nidn,prodi,jafung,no_wa,tgl_lahir,foto) VALUES(NULL,'$username','$email', md5('$password'),'$repass','$level','$nama','$nidn','$prodi','$jafung','$wa','$tgl_lahir','$file_name')");
            header('location: profil.php?pesan=success');
        }
    } else {
        header('location: profil.php?pesan=warning');
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
        /*hide pass */
        a,
        a:hover {
            color: #333
        }

        /* menu actv */
        li.active {
            background-color: #464646;
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->

        <?php include('../layout/sidebar.php'); ?>

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

                    <!-- Content Row -->
                    <div class="row">

                    </div>

                    <?php
                    if (isset($_GET['pesan'])) {
                        if ($_GET['pesan'] == "success") {
                            echo " <div class='alert alert-success'>
                                    <strong>Berhasil simpan data</strong>
                                    </div>
                                    <meta http-equiv='refresh' content='1; url= profil.php'/>  ";
                        } elseif ($_GET['pesan'] == "succes") {
                            echo " <div class='alert alert-success'>
                                    <strong>Berhasil ubah data</strong>
                                     </div><meta http-equiv='refresh' content='1; url= profil.php'/>  ";
                        } elseif ($_GET['pesan'] == "succesd") {
                            echo " <div class='alert alert-success'>
                                    <strong>Berhasil hapus data</strong>
                                    </div>
                                     <meta http-equiv='refresh' content='1; url= profil.php'/>  ";
                        } elseif ($_GET['pesan'] == "warning") {
                            echo "<div class='alert alert-warning'>
                                    <strong>Gagal simpan data</strong>
                                    </div> <meta http-equiv='refresh' content='1; url= profil.php'/>";
                        } else {
                            echo "<div class='alert alert-warning'>
                                    <strong>Gagal hapus data</strong>
                                     </div>
                                 <meta http-equiv='refresh' content='1; url= profil.php'/> ";
                        }
                    }
                    ?>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-primary">Data akun</h5>
                        </div>
                        <div class="card-body">
                            <div class="col-auto">
                                <button type="button" class="btn btn-success font-weight-bold" id="btn-add-data" data-toggle="modal" data-target="#myModal"><i class="fas fa-plus-circle mr-2"></i>Tambah Data</button>
                            </div><br>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Id user</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>Level</th>
                                            <th>Foto</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $user = mysqli_query($koneksi, "SELECT * from user order by id_user DESC");
                                        $no = 1;
                                        while ($f = mysqli_fetch_array($user)) {
                                            $id_user = $f['id_user'];
                                        ?>
                                            <tr>
                                                <td><?php echo $no++ ?></td>
                                                <td><?php echo $f['id_user'] ?></td>
                                                <td><?php echo $f['username'] ?></td>
                                                <td><?php echo $f['email'] ?></td>
                                                <td><?php echo $f['repassword'] ?></td>
                                                <td><?php echo $f['level'] ?></td>
                                                <td align="center"><?php echo "<img src='../img/$f[foto]' width='70' height='70' />"; ?></td>

                                                <td><button class="btn btn-warning btn-circle" data-toggle="modal" data-target="#edit<?= $id_user; ?>"><i class="fa fa-pen"></i></button>
                                                    <button data-toggle="modal" data-target="#del<?= $id_user; ?>" class="btn btn-danger btn-circle"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>

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
                                                                    <label for="password">Password</label>
                                                                    <div class="input-group" id="show_hide_password">
                                                                        <input type="password" name="password" class="form-control" value="<?php echo $f['password'] ?>">
                                                                        <div class="input-group-append">
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
                                                                <div class="form-group">
                                                                    <label>Level</label>
                                                                    <select name="level" class="custom-select form-control">
                                                                        <option value="<?= $f['level'] ?>"><?= $f['level'] ?></option>
                                                                        <option value="administrator">admin</option>
                                                                        <option value="user">user</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="nama">Nama</label>
                                                                    <input type="text" id="nama" name="nama" class="form-control" value="<?php echo $f['nama'] ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="ni">Nomor induk dosen nasional</label>
                                                                    <input type="text" id="ni" name="nidn" class="form-control" value="<?php echo $f['nidn'] ?>">
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

                                            <!-- The Modal -->
                                            <div class="modal fade" id="del<?= $id_user; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form method="post">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Hapus data <?php echo $f['nama'] ?></h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>

                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus user ini?
                                                                <input type="hidden" name="id_user" value="<?= $id_user; ?>">
                                                            </div>

                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-danger" name="hapus">Hapus</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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

    <!-- modal input -->
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Input User</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action=" " method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Username</label>
                            <input name="username" type="text" class="form-control" placeholder="username" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input name="email" type="email" class="form-control" placeholder="email" required>
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <div class="input-group" id="show_hide_password">
                                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password">Ulangi Password</label>
                            <div class="input-group" id="show_hide_password">
                                <input type="password" name="repassword" class="form-control" placeholder="Ulangi password" required>
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Level</label>
                            <select name="level" class="custom-select form-control" required>
                                <option value="">Pilih Level</option>
                                <option value="administrator">Administrator</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama</label>
                            <input name="nama" type="text" class="form-control" placeholder="nama" required>
                        </div>
                        <div class="form-group">
                            <label>Nomor induk dosen nasional</label>
                            <input name="nidn" type="text" min="0" class="form-control" placeholder="nidn" required>
                        </div>
                        <div class="form-group">
                            <label>Prodi</label>
                            <select name="prodi" class="custom-select form-control" required>
                                <option value="">Pilih prodi</option>
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
                                <option value="">Pilih jafung</option>
                                <option value="aa">AA</option>
                                <option value="lektor">Lektor</option>
                                <option value="guru besar">Guru Besar</option>
                                <option value="belum">Belum</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>WhatsApp</label>
                            <input name="no_wa" type="text" class="form-control" placeholder="nomor whatsapp" required>
                        </div>
                        <div class="form-group">
                            <label>Tanggal lahir</label>
                            <input name="tgl_lahir" type="date" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="file" class="font-weight-bold text-primary">Foto</label>
                            <input type="file" class="form-control-file" id="file" name="foto">
                        </div>
                        <div class="mb-3">
                            <img class="img-thumbnail" id="myImg">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <input type="submit" name="simpan" class="btn btn-primary" value="Simpan">
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- javascript -->
    <?php include('../layout/down.php'); ?>
    <script>
        //change foto tampil
        $("#file").on("change", function() {
            const myimg = document.getElementById("myImg");
            const input = document.getElementById("file");
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    myimg.src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                myimg.src = "";
            }
        });

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