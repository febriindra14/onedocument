<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/unuyo.png" type="">
    <title>One document - Register</title>

    <!-- Custom fonts for this template-->
    <link href="template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="template/css/sb-admin-2.min.css" rel="stylesheet">

    <style>
        .logo-login {
            max-height: 140px;
            margin-bottom: 20px;
        }

        a,
        a:hover {
            color: #333
        }
    </style>

</head>

<body class="bg-gradient-success">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">
            <!-- lebar card -->
            <div class="col-xl-5 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <!--<div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <img src="img/unuyo.png" class="logo-login">
                                        <h1 class="h5 text-gray-900 mb-3">Silahkan registrasi</h1>
                                        <h1 class="h4 text-gray-900 mb-3">Aplikasi One Document</h1>
                                    </div>

                                    <form action="add_user.php" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control form-control-user" placeholder="Masukkan username" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user" placeholder="Masukkan email" required>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group" id="show_hide_password">
                                                <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group" id="show_hide_password">
                                                <input type="password" name="repassword" class="form-control" placeholder="Ulangi Password" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" name="level" id="" value="user">

                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" placeholder="Masukkan nama" name="nama" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="nidn" class="form-control form-control-user" placeholder="Nomor induk dosen nasional" required>
                                        </div>
                                        <div class="form-group">
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
                                            <select name="jafung" class="custom-select form-control" required>
                                                <option value="">Jabatan Fungsional</option>
                                                <option value="AA">AA</option>
                                                <option value="Lektor">Lektor</option>
                                                <option value="guru besar">Guru besar</option>
                                                <option value="belum">Belum</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="no_wa" class="form-control form-control-user" placeholder="Nomor WhatsApp" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal_lahir">Tanggal Lahir</label>
                                            <input type="date" name="tgl_lahir" class="form-control datepicker" placeholder="Tanggal Lahir" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="file" class="font-weight-bold text-primary">Foto</label>
                                            <input type="file" class="form-control-file" id="file" name="foto" accept=".jpg , .png , .jpeg">
                                        </div>
                                        <div class="mb-3">
                                            <img class="img-thumbnail" id="myImg">
                                        </div>

                                        <button class="btn btn-primary btn-user btn-block" type="submit">
                                            Daftar akun
                                        </button>

                                    </form>
                                    <hr>

                                    <div class="text-center">
                                        Sudah punya akun? <a class="small text-primary" href="index.php">Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="template/vendor/jquery/jquery.min.js"></script>
    <script src="template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="template/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="template/js/sb-admin-2.min.js"></script>
    <script>
        // save file foto di folder one document

        //
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

        //show.hide.password
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