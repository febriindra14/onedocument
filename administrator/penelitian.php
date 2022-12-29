<?php
session_start();
//jika belum login tapi akses harus login
if ($_SESSION['level'] == "") {
    header('location:../index.php');
}
$page = "penelitian";
?>
<!DOCTYPE html>
<html lang="en">
<?php
include '../config.php';

//edit penelitian
if (isset($_POST['update'])) {
    $idpen = $_POST['id_penelitian'];
    $ids = $_POST['id_user'];
    $kat = $_POST['kategori'];
    $jdl = $_POST['judul'];
    $afiliasi = $_POST['afiliasi'];
    $ta_usulan = $_POST['tahun_usulan'];
    $thn_keg = $_POST['tahun_kegiatan'];
    $thn_pelak = $_POST['tahun_pelaksanaan'];
    $lam_kegi = $_POST['lama_kegiatan'];
    $da_dikti = $_POST['dana_dikti'];
    $inkind = $_POST['in_kind'];
    $nosk = $_POST['no_sk_penugasan'];
    $tgl_tugas = $_POST['tanggal_penugasan'];

    $file = $_FILES['upload']['name'];
    if (empty($file)) {
        $koneksi->query("UPDATE penelitian SET id_user='$ids', kategori='$kat', judul='$jdl', afiliasi='$afiliasi', tahun_usulan='$ta_usulan', tahun_kegiatan='$thn_keg', tahun_pelaksanaan='$thn_pelak', lama_kegiatan='$lam_kegi', dana_dikti='$da_dikti', in_kind='$inkind', no_sk_penugasan='$nosk', tanggal_penugasan='$tgl_tugas' WHERE id_penelitian=$idpen ");
        echo " <div class='alert alert-success'>
                <strong>Success!</strong>
                </div><meta http-equiv='refresh' content='1; url= penelitian.php'/>  ";
    } else {
        $hapus = $koneksi->query("SELECT * FROM penelitian WHERE id_penelitian=$idp");
        $nama_dokumen = mysqli_fetch_array($hapus);
        $lokasi = $nama_dokumen['upload'];
        $hapus_dokumnen = "../dokumen/" . $lokasi;
        unlink($hapus_dokumnen);
        move_uploaded_file($_FILES['upload']['tmp_name'], "../dokumen/" . $file);
        $koneksi->query("UPDATE penelitian SET id_user='$ids', kategori='$kat', judul='$jdl', afiliasi='$afiliasi', tahun_usulan='$ta_usulan', tahun_kegiatan='$thn_keg', tahun_pelaksanaan='$thn_pelak', lama_kegiatan='$lam_kegi', dana_dikti='$da_dikti', in_kind='$inkind', no_sk_penugasan='$nosk', tanggal_penugasan='$tgl_tugas', upload='$file' WHERE id_penelitian=$idpen ");
        echo "<div class='alert alert-success'>
                <strong>Success!</strong>
                </div><meta http-equiv='refresh' content='1; url= penelitian.php'/>  ";
    }
};
//delete
if (isset($_POST['hapus'])) {
    $idpen = $_POST['id_penelitian'];

    $hapus = $koneksi->query("SELECT * FROM penelitian WHERE id_penelitian=$idpen");
    $nama_dokumen = mysqli_fetch_array($hapus);
    $lokasi = $nama_dokumen['upload'];
    $hapus_dokumnen = "../dokumen/" . $lokasi;
    unlink($hapus_dokumnen);

    $delete = mysqli_query($koneksi, "DELETE FROM penelitian WHERE id_penelitian='$idpen'");
    //cek apakah berhasil
    if ($delete) {
        echo " <div class='alert alert-success'>
            <strong>Success!</strong>
          </div>
        <meta http-equiv='refresh' content='1; url= penelitian.php'/>  ";
    } else {
        echo "<div class='alert alert-warning'>
            <strong>Failed!</strong>
          </div>
         <meta http-equiv='refresh' content='1; url= penelitian.php'/> ";
    }
};
//input
if (isset($_POST['simpan'])) {
    $ids = $_POST['id_user'];
    $kat = $_POST['kategori'];
    $jdl = $_POST['judul'];
    $afiliasi = $_POST['afiliasi'];
    $ta_usulan = $_POST['tahun_usulan'];
    $thn_keg = $_POST['tahun_kegiatan'];
    $thn_pelak = $_POST['tahun_pelaksanaan'];
    $lam_kegi = $_POST['lama_kegiatan'];
    $da_dikti = $_POST['dana_dikti'];
    $inkind = $_POST['in_kind'];
    $nosk = $_POST['no_sk_penugasan'];
    $tgl_tugas = $_POST['tanggal_penugasan'];

    if (isset($_FILES['upload']['name'])) {
        $file_name = $_FILES['upload']['name'];
        $file_tmp = $_FILES['upload']['tmp_name'];
        move_uploaded_file($file_tmp, "../dokumen/" . $file_name);
        $query = mysqli_query($koneksi, "INSERT INTO penelitian VALUES(NULL,'$ids','$kat','$jdl','$afiliasi','$ta_usulan','$thn_keg','$thn_pelak','$lam_kegi','$da_dikti','$inkind','$nosk','$tgl_tugas','$file_name')");
        if ($query) {
            echo " <div class='alert alert-success'>
            <strong>Success!</strong>
          </div>
        <meta http-equiv='refresh' content='1; url= penelitian.php'/>  ";
        } else {
            echo "<div class='alert alert-warning'>
            <strong>Failed!</strong>
          </div>
         <meta http-equiv='refresh' content='1; url= penelitian.php'/> ";
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
    <title>One document - Penelitian</title>
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
                        <!--<h1 class="h3 mb-0 text-gray-800">Penelitian</h1> -->
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h5 class="m-0 font-weight-bold text-primary">Data penelitian</h5>
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
                                            <th>Id penelitian</th>
                                            <th>Id user</th>
                                            <th>Kategori</th>
                                            <th>Judul</th>
                                            <th>Afiliasi</th>
                                            <th>Tahun usulan</th>
                                            <th>Tahun kegiatan</th>
                                            <th>Tahun pelaksanaan</th>
                                            <th>Lama kegiatan</th>
                                            <th>Dana dikti</th>
                                            <th>In kind</th>
                                            <th>No Sk</th>
                                            <th>Tanggal penugasan</th>
                                            <th>Upload</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $user = mysqli_query($koneksi, "SELECT * FROM penelitian ORDER BY id_penelitian ASC");
                                        $no = 1;
                                        while ($f = mysqli_fetch_array($user)) {
                                            $id_penelitian = $f['id_penelitian'];
                                        ?>
                                            <tr>
                                                <td><?php echo $no++ ?></td>
                                                <td><?php echo $f['id_penelitian'] ?></td>
                                                <td><?php echo $f['id_user'] ?></td>
                                                <td><?php echo $f['kategori'] ?></td>
                                                <td><?php echo $f['judul'] ?></td>
                                                <td><?php echo $f['afiliasi'] ?></td>
                                                <td><?php echo $f['tahun_usulan'] ?></td>
                                                <td><?php echo $f['tahun_kegiatan'] ?></td>
                                                <td><?php echo $f['tahun_pelaksanaan'] ?></td>
                                                <td><?php echo $f['lama_kegiatan'] ?></td>
                                                <td><?php echo $f['dana_dikti'] ?></td>
                                                <td><?php echo $f['in_kind'] ?></td>
                                                <td><?php echo $f['no_sk_penugasan'] ?></td>
                                                <td><?php echo $f['tanggal_penugasan'] ?></td>
                                                <td><?php echo $f['upload'] ?></td>
                                                <td><button class="btn btn-warning btn-circle" data-toggle="modal" data-target="#edit<?= $id_penelitian; ?>"><i class="fa fa-pen"></i></button>
                                                    <button data-toggle="modal" data-target="#del<?= $id_penelitian; ?>" class="btn btn-danger btn-circle"><i class="fa fa-trash"></i></button>
                                                    <button data-toggle="modal" data-target="#preview<?= $id_penelitian; ?>" class="btn btn-info btn-circle"><i class="fa fa-info"></i></button>
                                                </td>
                                            </tr>

                                            <!-- The Modal -->
                                            <div class="modal fade" id="edit<?= $id_penelitian; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form method="post" enctype="multipart/form-data">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit penelitian</h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>

                                                            <!-- Modal body -->
                                                            <div class="modal-body">

                                                                <div class="form-group">
                                                                    <label for="id_user">id_user</label>
                                                                    <input type="text" id="id_user" name="id_user" class="form-control" value="<?php echo $f['id_user'] ?>" readonly>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Kategori</label>
                                                                    <select name="kategori" class="custom-select form-control">
                                                                        <option value="<?= $f['kategori'] ?>"><?= $f['kategori'] ?></option>
                                                                        <option value="ketua">Ketua</option>
                                                                        <option value="sekretaris">Sekretaris</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="judul">Judul</label>
                                                                    <input type="text" id="judul" name="judul" class="form-control" value="<?php echo $f['judul'] ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="afi">Afiliasi</label>
                                                                    <input type="text" id="afi" name="afiliasi" class="form-control" value="<?php echo $f['afiliasi'] ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="tu">Tahun usulan</label>
                                                                    <input type="date" id="tu" name="tahun_usulan" class="form-control" value="<?php echo $f['tahun_usulan'] ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="tk">Tahun kegiatan</label>
                                                                    <input type="date" id="tk" name="tahun_kegiatan" class="form-control" value="<?php echo $f['tahun_kegiatan'] ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="tp">Tahun pelaksanaan</label>
                                                                    <input type="date" id="tp" name="tahun_pelaksanaan" class="form-control" value="<?php echo $f['tahun_pelaksanaan'] ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Lama kegiatan</label>
                                                                    <select name="lama_kegiatan" class="custom-select form-control">
                                                                        <option value="<?= $f['lama_kegiatan'] ?>"><?= $f['lama_kegiatan'] ?></option>
                                                                        <option value="3 bulan">3 Bulan</option>
                                                                        <option value="6 bulan">6 Bulan</option>
                                                                        <option value="1 tahun">1 Tahun</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Dana dikti</label>
                                                                    <div class="input-group">
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text">Rp</span>
                                                                        </div>
                                                                        <input type="text" name="dana_dikti" class="form-control" value="<?php echo $f['dana_dikti'] ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">In kind</label>
                                                                    <div class="input-group">
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text">Rp</span>
                                                                        </div>
                                                                        <input type="text" name="in_kind" class="form-control" value="<?php echo $f['in_kind'] ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>No Sk Tugas</label>
                                                                    <input name="no_sk_penugasan" type="text" class="form-control" value="<?php echo $f['no_sk_penugasan'] ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Tanggal penugasan</label>
                                                                    <input name="tanggal_penugasan" type="date" class="form-control" value="<?php echo $f['tanggal_penugasan'] ?>">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="file" class="font-weight-bold text-primary">Dokumen (.pdf)</label>
                                                                    <input type="file" class="form-control-file" id="file" name="upload" accept=".pdf">
                                                                </div>
                                                                <span><?= $f['upload']; ?></span>
                                                                <embed src="../dokumen/<?= $f['upload'] ?>" type="" frameborder="0" width="100%" height="500px">

                                                                <input type="hidden" name="id_penelitian" value="<?= $id_penelitian; ?>">

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
                                            <div class="modal fade" id="del<?= $id_penelitian; ?>">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <form method="post">
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Hapus data <?php echo $f['id_penelitian'] ?></h4>
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>

                                                            <!-- Modal body -->
                                                            <div class="modal-body">
                                                                Apakah Anda yakin ingin menghapus data ini?
                                                                <input type="hidden" name="id_penelitian" value="<?= $id_penelitian; ?>">
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
                                            <div class="modal fade" role="dialog" id="preview<?= $id_penelitian; ?>">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">

                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Download</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <!-- Modal body -->
                                                        <div class="modal-body">
                                                            <embed src="../dokumen/<?= $f['upload'] ?>" type="" frameborder="0" width="100%" height="800px">
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
                    <h4 class="modal-title">Input Penelitian</h4>
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
                            <label>Kategori</label>
                            <select name="kategori" class="custom-select form-control" required>
                                <option value="">Pilih kategori</option>
                                <option value="ketua">Ketua</option>
                                <option value="sekretaris">Sekretaris</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Judul</label>
                            <input name="judul" type="text" class="form-control" placeholder="Masukkan judul" required>
                        </div>
                        <div class="form-group">
                            <label>Afiliasi</label>
                            <input name="afiliasi" type="text" class="form-control" placeholder="Masukkan afiliasi" required>
                        </div>
                        <div class="form-group">
                            <label>Tahun usulan</label>
                            <input name="tahun_usulan" type="date" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Tahun kegiatan</label>
                            <input name="tahun_kegiatan" type="date" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Tahun pelaksanaan</label>
                            <input name="tahun_pelaksanaan" type="date" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Lama kegiatan</label>
                            <select name="lama_kegiatan" class="custom-select form-control" required>
                                <option value="">Berapa lama</option>
                                <option value="3 bulan">3 Bulan</option>
                                <option value="6 bulan">6 Bulan</option>
                                <option value="1 tahun">1 Tahun</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Dana dikti</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="text" name="dana_dikti" class="form-control" placeholder="Masukkan dana dikti" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">In kind</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="text" name="in_kind" class="form-control" placeholder="Masukkan in kind" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>No Sk Tugas</label>
                            <input name="no_sk_penugasan" type="text" class="form-control" placeholder="Masukkan no sk" required>
                        </div>
                        <div class="form-group">
                            <label>Tanggal penugasan</label>
                            <input name="tanggal_penugasan" type="date" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="file" class="font-weight-bold text-primary">Dokumen (.pdf)</label>
                            <input type="file" class="form-control-file" id="file" name="upload" accept=".pdf">
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