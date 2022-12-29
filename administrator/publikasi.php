<?php
session_start();
//jika belum login tapi akses harus login
if ($_SESSION['level'] == "") {
    header('location:../index.php');
}
$page = "publikasi";
?>
<!DOCTYPE html>
<html lang="en">
<?php
include '../config.php';

//edit publikasi
if (isset($_POST['update'])) {
    $idp = $_POST['id_publikasi'];
    $ids = $_POST['id_user'];
    $jenis = $_POST['jenis'];
    $kat = $_POST['kategori'];
    $jdl = $_POST['judul'];
    $tgl_terbit = $_POST['tanggal_terbit'];
    $jml_hal = $_POST['jml_hal'];
    $penerbit = $_POST['penerbit'];
    $isbn = $_POST['isbn'];
    $link = $_POST['tautan'];

    $file = $_FILES['dokumen']['name'];
    if (empty($file)) {
        $koneksi->query("UPDATE publikasi SET id_user='$ids', jenis='$jenis', kategori='$kat', judul='$jdl', tanggal_terbit='$tgl_terbit', jml_hal='$jml_hal', penerbit='$penerbit', isbn='$isbn', tautan='$link' WHERE id_publikasi=$idp ");
        echo " <div class='alert alert-success'>
                <strong>Success!</strong>
                </div><meta http-equiv='refresh' content='1; url= publikasi.php'/>  ";
    } else {
        $hapus = $koneksi->query("SELECT * FROM publikasi WHERE id_publikasi=$idp");
        $nama_dokumen = mysqli_fetch_array($hapus);
        $lokasi = $nama_dokumen['dokumen'];
        $hapus_dokumnen = "../dokumen/" . $lokasi;
        unlink($hapus_dokumnen);
        move_uploaded_file($_FILES['dokumen']['tmp_name'], "../dokumen/" . $file);
        $koneksi->query("UPDATE publikasi SET id_user='$ids', jenis='$jenis', kategori='$kat', judul='$jdl', tanggal_terbit='$tgl_terbit', jml_hal='$jml_hal', penerbit='$penerbit', isbn='$isbn', tautan='$link', dokumen='$file' WHERE id_publikasi=$idp ");
        echo "<div class='alert alert-success'>
                <strong>Success!</strong>
                </div><meta http-equiv='refresh' content='1; url= publikasi.php'/>  ";
    }
};
//delete
if (isset($_POST['hapus'])) {
    $idp = $_POST['id_publikasi'];

    $hapus = $koneksi->query("SELECT * FROM publikasi WHERE id_publikasi=$idp");
    $nama_dokumen = mysqli_fetch_array($hapus);
    $lokasi = $nama_dokumen['dokumen'];
    $hapus_dokumnen = "../dokumen/" . $lokasi;
    unlink($hapus_dokumnen);

    $delete = mysqli_query($koneksi, "DELETE FROM publikasi WHERE id_publikasi='$idp'");
    //cek apakah berhasil
    if ($delete) {
        echo " <div class='alert alert-success'>
            <strong>Success!</strong>
          </div>
        <meta http-equiv='refresh' content='1; url= publikasi.php'/>  ";
    } else {
        echo "<div class='alert alert-warning'>
            <strong>Failed!</strong>
          </div>
         <meta http-equiv='refresh' content='1; url= publikasi.php'/> ";
    }
};
if (isset($_POST['simpan'])) {
    $ids = $_POST['id_user'];
    $jenis = $_POST['jenis'];
    $kat = $_POST['kategori'];
    $jdl = $_POST['judul'];
    $tgl_terbit = $_POST['tanggal_terbit'];
    $jml_hal = $_POST['jml_hal'];
    $penerbit = $_POST['penerbit'];
    $isbn = $_POST['isbn'];
    $link = $_POST['tautan'];

    if (isset($_FILES['dokumen']['name'])) {
        $file_name = $_FILES['dokumen']['name'];
        $file_tmp = $_FILES['dokumen']['tmp_name'];
        move_uploaded_file($file_tmp, "../dokumen/" . $file_name);
        $query = mysqli_query($koneksi, "INSERT INTO publikasi VALUES(NULL,'$ids','$jenis','$kat','$jdl','$tgl_terbit','$jml_hal','$penerbit','$isbn','$link','$file_name')");
        if ($query) {
            echo " <div class='alert alert-success'>
            <strong>Success!</strong>
          </div>
        <meta http-equiv='refresh' content='1; url= publikasi.php'/>  ";
        } else {
            echo "<div class='alert alert-warning'>
            <strong>Failed!</strong>
          </div>
         <meta http-equiv='refresh' content='1; url= publikasi.php'/> ";
        }
    } else {
        echo "<div class='alert alert-warning'>
            <strong>MAAF GAGAL</strong>
          </div>";
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
    <title>One document - Publikasi</title>
    <?php include('../layout/header.php'); ?>
    <style>
        /* menu actv */
        li.active,
        a.nav-link:hover {
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
                        <!--<h1 class="h3 mb-0 text-gray-800">Publikasi</h1> -->
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>
                    <!-- Content Row -->
                    <div class="row">

                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-primary">Data publikasi</h5>
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
                                            <th>Id publikasi</th>
                                            <th>Id user</th>
                                            <th>Jenis</th>
                                            <th>Kategori</th>
                                            <th>Judul</th>
                                            <th>Tanggal terbit</th>
                                            <th>Jml halaman</th>
                                            <th>Penerbit</th>
                                            <th>Isbn</th>
                                            <th>Tautan</th>
                                            <th>Dokumen</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $user = mysqli_query($koneksi, "SELECT * FROM publikasi JOIN user ON user.id_user = publikasi.id_user ORDER BY id_publikasi ASC");
                                        $no = 1;
                                        while ($f = mysqli_fetch_array($user)) {
                                            $id_publikasi = $f['id_publikasi'];
                                        ?>
                                            <tr>
                                                <td><?php echo $no++ ?></td>
                                                <td><?php echo $f['id_publikasi'] ?></td>
                                                <td><?php echo $f['id_user'] ?></td>
                                                <td><?php echo $f['jenis'] ?></td>
                                                <td><?php echo $f['kategori'] ?></td>
                                                <td><?php echo $f['judul'] ?></td>
                                                <td><?php echo $f['tanggal_terbit'] ?></td>
                                                <td><?php echo $f['jml_hal'] ?></td>
                                                <td><?php echo $f['penerbit'] ?></td>
                                                <td><?php echo $f['isbn'] ?></td>
                                                <td><?php echo $f['tautan'] ?></td>
                                                <td><?php echo $f['dokumen'] ?></td>
                                                <td><button class="btn btn-warning btn-circle" data-toggle="modal" data-target="#edit<?= $id_publikasi; ?>"><i class="fa fa-pen"></i></button>
                                                    <button data-toggle="modal" data-target="#del<?= $id_publikasi; ?>" class="btn btn-danger btn-circle"><i class="fa fa-trash"></i></button>
                                                    <button data-toggle="modal" data-target="#preview<?= $id_publikasi; ?>" class="btn btn-info btn-circle"><i class="fa fa-info"></i></button>
                                                </td>
                                            </tr>

                                            <!-- The Modal -->
                                            <div class="modal fade" id="edit<?= $id_publikasi; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form method="post" enctype="multipart/form-data">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit publikasi</h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>

                                                            <!-- Modal body -->
                                                            <div class="modal-body">

                                                                <div class="form-group">
                                                                    <label for="id_user">id_user</label>
                                                                    <input type="text" id="id_user" name="id_user" class="form-control" value="<?php echo $f['id_user'] ?>" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Jenis</label>
                                                                    <select name="jenis" class="custom-select form-control">
                                                                        <option value="<?= $f['jenis'] ?>"><?= $f['jenis'] ?></option>
                                                                        <option value="jurnal internasional">Jurnal internasional</option>
                                                                        <option value="jurnal internasional bereputasi">Jurnal internasional bereputasi</option>
                                                                        <option value="jurnal nasional">Jurnal nasional</option>
                                                                        <option value="jurnal nasional bereputasi">Jurnal nasional bereputasi</option>
                                                                        <option value="prosidiy">Prosidiy</option>
                                                                        <option value="tulisan ilmiah">Tulisan ilmiah</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Kategori</label>
                                                                    <select name="kategori" class="custom-select form-control">
                                                                        <option value="<?= $f['kategori'] ?>"><?= $f['kategori'] ?></option>
                                                                        <option value="pembicara">Pembicara</option>
                                                                        <option value="publikasi">Publikasi</option>
                                                                        <option value="hki">Hki</option>
                                                                        <option value="buku">Buku</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="judul">Judul</label>
                                                                    <input type="text" id="judul" name="judul" class="form-control" value="<?php echo $f['judul'] ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="tl">Tanggal terbit</label>
                                                                    <input type="date" id="tl" name="tanggal_terbit" class="form-control" value="<?php echo $f['tanggal_terbit'] ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="jml_hal">Jumlah halaman</label>
                                                                    <input type="number" id="jml_hal" name="jml_hal" class="form-control" value="<?php echo $f['jml_hal'] ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="penerbit">Penerbit</label>
                                                                    <input type="text" id="penerbit" name="penerbit" class="form-control" value="<?php echo $f['penerbit'] ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="isbn">Isbn</label>
                                                                    <input type="text" id="isbn" name="isbn" class="form-control" value="<?php echo $f['isbn'] ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="link">Tautan</label>
                                                                    <input type="text" id="link" name="tautan" class="form-control" value="<?php echo $f['tautan'] ?>">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="file" class="font-weight-bold text-primary">Dokumen (.pdf)</label>
                                                                    <input type="file" class="form-control-file" id="file" name="dokumen" accept=".pdf">
                                                                </div>
                                                                <span><?= $f['dokumen']; ?></span>
                                                                <embed src="../dokumen/<?= $f['dokumen'] ?>" type="" frameborder="0" width="100%" height="500px">

                                                                <input type="hidden" name="id_publikasi" value="<?= $id_publikasi; ?>">

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
                                            <div class="modal fade" id="del<?= $id_publikasi; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form method="post">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Hapus data <?php echo $f['id_publikasi'] ?></h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>

                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus data ini?
                                                                <input type="hidden" name="id_publikasi" value="<?= $id_publikasi; ?>">
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

                                            <!-- The Modal dokumen -->
                                            <div class="modal fade" role="dialog" id="preview<?= $id_publikasi; ?>">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Download</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <embed src="../dokumen/<?= $f['dokumen'] ?>" type="" frameborder="0" width="100%" height="800px">
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>

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
                    <h4 class="modal-title">Input Publikasi</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action=" " method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label?>id user</label>
                                <select name="id_user" class="custom-select form-control" required>
                                    <option value="">Pilih</option>
                                    <?php
                                    $query = mysqli_query($koneksi, "SELECT * FROM user ORDER BY id_user ASC");
                                    while ($data = mysqli_fetch_array($query)) {
                                    ?>
                                        <option value="<?php echo $data['id_user']; ?>"><?php echo $data['id_user']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                        </div>
                        <div class="form-group">
                            <label>Jenis</label>
                            <select name="jenis" class="custom-select form-control" required>
                                <option value="">Jenis</option>
                                <option value="jurnal internasional">Jurnal internasional</option>
                                <option value="jurnal internasional bereputasi">Jurnal internasional bereputasi</option>
                                <option value="jurnal nasional">Jurnal nasional</option>
                                <option value="jurnal nasional bereputasi">Jurnal nasional bereputasi</option>
                                <option value="prosidiy">Prosidiy</option>
                                <option value="tulisan ilmiah">Tulisan ilmiah</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="kategori" class="custom-select form-control" required>
                                <option value="">Pilih kategori</option>
                                <option value="pembicara">Pembicara</option>
                                <option value="publikasi">Publikasi</option>
                                <option value="hki">Hki</option>
                                <option value="buku">Buku</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Judul</label>
                            <input name="judul" type="text" class="form-control" placeholder="Masukkan judul" required>
                        </div>
                        <div class="form-group">
                            <label>Tanggal terbit</label>
                            <input name="tanggal_terbit" type="date" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Jumlah halaman</label>
                            <input name="jml_hal" type="number" class="form-control" placeholder="Masukkan jumlah halaman" required>
                        </div>
                        <div class="form-group">
                            <label>Penerbit</label>
                            <input name="penerbit" type="text" class="form-control" placeholder="Masukkan penerbit" required>
                        </div>
                        <div class="form-group">
                            <label>Isbn</label>
                            <input name="isbn" type="text" class="form-control" placeholder="Masukkan isbn" required>
                        </div>
                        <div class="form-group">
                            <label>Tautan</label>
                            <input name="tautan" type="text" class="form-control" placeholder="link" required>
                        </div>
                        <div class="mb-3">
                            <label for="file" class="font-weight-bold text-primary">Dokumen (.pdf)</label>
                            <input type="file" class="form-control-file" id="file" name="dokumen" accept=".pdf">
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

</body>

</html>