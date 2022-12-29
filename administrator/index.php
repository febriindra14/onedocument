<?php
session_start();
//jika belum login tapi akses harus login
if ($_SESSION['level'] == "") {
    header('location:../index.php');
}
$page = "home";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../img/unuyo.png" type="">
    <title>One document - Dashboard</title>
    <?php include('../layout/header.php'); ?>

    <style>
        /* menu actv */
        li.active,
        a.nav-link:hover {
            background-color: #464646;
        }

        /*li.active,
        a:hover {
            background-color: #d4daed;
        }

        span {
            color: #000000;
        }

        li a.nav-link span:hover {
            color: #fff;
        } */
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
                        <h1 class="h3 mb-0 text-gray-800">Selamat datang <?= $_SESSION['nama'] ?> </h1>
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <?php
                        include '../config.php';
                        $a = mysqli_query($koneksi, "SELECT COUNT(id_user) as jumlah FROM user");
                        $b = mysqli_fetch_array($a)
                        ?>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-lg font-weight-bold text-primary text-uppercase mb-2">
                                                Akun</div>
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?= $b['jumlah'] ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-address-card fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        $a = mysqli_query($koneksi, "SELECT COUNT(id_penelitian) as jumlah FROM penelitian");
                        $b = mysqli_fetch_array($a)
                        ?>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-lg font-weight-bold text-success text-uppercase mb-1">
                                                Penelitian</div>
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?= $b['jumlah'] ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-hands-helping fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        $a = mysqli_query($koneksi, "SELECT COUNT(id_pengabdian) as jumlah FROM pengabdian");
                        $b = mysqli_fetch_array($a)
                        ?>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-lg font-weight-bold text-info text-uppercase mb-1">Pengabdian
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h3 mb-0 mr-3 font-weight-bold text-gray-800"><?= $b['jumlah'] ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-people-carry fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        $a = mysqli_query($koneksi, "SELECT COUNT(id_publikasi) as jumlah FROM publikasi");
                        $b = mysqli_fetch_array($a)
                        ?>
                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-lg font-weight-bold text-warning text-uppercase mb-1">
                                                Publikasi</div>
                                            <div class="h3 mb-0 font-weight-bold text-gray-800"><?= $b['jumlah'] ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-book-open fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
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

    <!-- javascript -->
    <?php include('../layout/down.php'); ?>


</body>

</html>