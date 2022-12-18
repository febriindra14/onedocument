<?php
session_start();
//jika belum login tapi akses harus login
if ($_SESSION['level'] == "") {
    header('location:../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<?php
include '../config.php';

//update user
if (isset($_POST['update'])) {
    $iduser = $_POST['id_user'];
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

    $updatedata = mysqli_query($koneksi, "UPDATE user SET username='$username', email='$email', password='$password', level='$level', nama='$nama', nidn='$nidn', prodi='$prodi', jafung='$jafung', no_wa='$wa', tgl_lahir='$tgl_lahir', foto='$foto' where id_user=$iduser ");

    //cek apakah berhasil
    if ($updatedata) {

        echo " <div class='alert alert-success'>
            <strong>Success!</strong> Redirecting you back in 1 seconds.
          </div>
        <meta http-equiv='refresh' content='1; url= akun.php'/>  ";
    } else {
        echo "<div class='alert alert-warning'>
            <strong>Failed!</strong> Redirecting you back in 1 seconds.
          </div>
         <meta http-equiv='refresh' content='1; url= akun.php'/> ";
    }
};

//delete
if (isset($_POST['hapus'])) {
    $id_user = $_POST['id_user'];

    $delete = mysqli_query($koneksi, "DELETE FROM user where id_user='$id_user'");
    //cek apakah berhasil
    if ($delete) {

        echo " <div class='alert alert-success'>
            <strong>Success!</strong> Redirecting you back in 1 seconds.
          </div>
        <meta http-equiv='refresh' content='1; url= akun.php'/>  ";
    } else {
        echo "<div class='alert alert-warning'>
            <strong>Failed!</strong> Redirecting you back in 1 seconds.
          </div>
         <meta http-equiv='refresh' content='1; url= akun.php'/> ";
    }
};

?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>one document - Akun</title>
    <?php include('../layout/header.php'); ?>
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
                        <h1 class="h3 mb-0 text-gray-800">User</h1>
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <!--<h6 class="m-0 font-weight-bold text-primary">User</h6>-->
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
                                            <th>Nama</th>
                                            <th>Nidn</th>
                                            <th>Prodi</th>
                                            <th>Jafung</th>
                                            <th>No_WA</th>
                                            <th>Tanggal lahir</th>
                                            <th>Foto</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $user = mysqli_query($koneksi, "SELECT * from user order by nama ASC");
                                        $no = 1;
                                        while ($f = mysqli_fetch_array($user)) {
                                            $id_user = $f['id_user'];
                                        ?>
                                            <tr>
                                                <td><?php echo $no++ ?></td>
                                                <td><?php echo $f['id_user'] ?></td>
                                                <td><?php echo $f['username'] ?></td>
                                                <td><?php echo $f['email'] ?></td>
                                                <td><?php echo $f['password'] ?></td>
                                                <td><?php echo $f['level'] ?></td>
                                                <td><?php echo $f['nama'] ?></td>
                                                <td><?php echo $f['nidn'] ?></td>
                                                <td><?php echo $f['prodi'] ?></td>
                                                <td><?php echo $f['jafung'] ?></td>
                                                <td><?php echo $f['no_wa'] ?></td>
                                                <td><?php echo $f['tgl_lahir'] ?></td>
                                                <td><?php echo $f['foto'] ?></td>
                                                <td><button class="btn btn-warning font-weight-bold" data-toggle="modal" data-target="#edit<?= $id_user; ?>"><i class="fas fa-info-circle mr-2"></i>Edit</button>
                                                    <button data-toggle="modal" data-target="#del<?= $id_user; ?>" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</button>
                                                </td>
                                            </tr>

                                            <!-- The Modal -->
                                            <div class="modal fade" id="edit<?= $id_user; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form method="post">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit user <?php echo $f['nama'] ?></h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>

                                                            <!-- Modal body -->
                                                            <div class="modal-body">

                                                                <label for="username">Username</label>
                                                                <input type="text" id="username" name="username" class="form-control" value="<?php echo $f['username'] ?>">

                                                                <label for="email">Email</label>
                                                                <input type="email" id="email" name="email" class="form-control" value="<?php echo $f['email'] ?>">

                                                                <Pabel for="password">Password</Pabel>
                                                                <input type="password" id="password" name="password" class="form-control" value="<?php echo $f['password'] ?>">

                                                                <!--<div class="form-group">
                                                                    <label>Level</label>
                                                                    <select name="level" class="custom-select form-control">
                                                                        <option value>Pilih Level</option>
                                                                        <option value="administrator" <?php if ($f == "administrator") {
                                                                                                            echo "selected=\"selected\"";
                                                                                                        } ?>>Administrator</option>
                                                                        <option value="user" <?php if ($f == "user") {
                                                                                                    echo "selected=\"selected\"";
                                                                                                } ?>>User</option>
                                                                    </select>
                                                                </div> -->

                                                                <label for="nama">Nama</label>
                                                                <input type="text" id="nama" name="nama" class="form-control" value="<?php echo $f['nama'] ?>">

                                                                <label for="nidn">Nomor induk dosen nasional</label>
                                                                <input type="text" id="nidn" name="nidn" class="form-control" value="<?php echo $f['nidn'] ?>">

                                                                <label for="whatsapp">WhatsApp</label>
                                                                <input type="text" id="whatsapp" name="no_wa" class="form-control" value="<?php echo $f['no_wa'] ?>">

                                                                <label for="tl">Tanggal lahir</label>
                                                                <input type="date" id="tl" name="tgl_lahir" class="form-control" value="<?php echo $f['tgl_lahir'] ?>">

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
                                                                <h4 class="modal-title">Hapus User <?php echo $f['nama'] ?> - <?php echo $f['id_user'] ?></h4>
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
                                                                <button type="submit" class="btn btn-success" name="hapus">Hapus</button>
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
                    <form action="created_user.php" method="post">
                        <div class="form-group">
                            <label>Username</label>
                            <input name="username" type="text" class="form-control" placeholder="username" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input name="email" type="email" class="form-control" placeholder="email" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input name="password" type="password" class="form-control" placeholder="password" required>
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
                            <input name="ukuran" type="text" class="form-control" placeholder="nama" required>
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
                            <!--accept=".jpg"> -->
                        </div>
                        <div class="mb-3">
                            <img class="img-thumbnail" id="myImg">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <input type="submit" class="btn btn-primary" value="Simpan">
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
    </script>

</body>

</html>