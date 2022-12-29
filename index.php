<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/unuyo.png" type="">
    <title>One document - Login</title>

    <!-- Custom fonts for this template-->
    <link href="template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="template/css/sb-admin-2.css" rel="stylesheet">

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
                            <!--<div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <img src="img/unuyo.png" class="logo-login">
                                        <!--<h1 class="h5 text-gray-900 mb-3">Login</h1> -->
                                        <h1 class="h4 text-gray-900 mb-3">Aplikasi One Document</h1>
                                    </div>
                                    <form action="cek_login.php" method="POST">
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
                                        </div>

                                        <!--<div class="form-group">
                                            <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                                        </div> -->

                                        <div class="form-group">
                                            <div class="input-group" id="show_hide_password">
                                                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--<div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div> -->
                                        <button class="btn btn-primary btn-user btn-block" type="submit">
                                            Login
                                        </button>

                                    </form>

                                    <!--<div class="text-center">
                                        <a class="small" href="#">Forgot Password?</a>
                                    </div> -->
                                    <hr>
                                    <div class="text-center">
                                        Belum punya akun? <a class="small text-primary" href="register.php">
                                            Buat akun!
                                        </a>
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