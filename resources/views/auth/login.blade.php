<!--
=========================================================
* Argon Dashboard 2 - v2.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        Argon Dashboard 2 by Creative Tim
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <style>
        .form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            background-color: white;
            padding: 60px;
            padding-inline: 28px;
            border-radius: 20px;
            /* border-color: black 4px 4px 4px; */
            box-shadow: 6px 6px #FF87B2;
            font-family: cursive;
            max-width: 450px;
            height: 425px;
            width: 100%;
        }

        .login {
            padding: 10px;
            border-radius: 10px;
            margin-top: 20px;
            background-color: white;
            box-shadow: 2px 3px rgb(0, 2, 65);
            color: rgb(0, 0, 0);
            font-size: medium;
            font-weight: 600;
            transition: 400ms;
            font-family: cursive;
        }
        
        .login:hover {
            background-color: #FF87B2;
            color: white;
            transition: 400ms;
            cursor: pointer;
        }

        .page-header{
            background-image: url('assets/img/aespa.jpg');
        }

        .page-header::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Warna gelap dengan opacity */
    }
    </style>
</head>

<body class="" style="background-color: #FFD0D0;" >
    <!-- Navbar -->
    <!-- End Navbar -->
    <main class="main-content mt-0">
        <div class="page-header align-items-start min-vh-50 pt-5 pb-1 m-3 border-radius-lg" style=" background-image: url(assets/img/aespa.jpg);">
            <span class="mask bg-gradient-dark opacity-6"></span>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 text-center mx-auto">
                        <h1 class="text-white mb-2 mt-5">HAI!</h1>
                        <p class="text-lead text-white">Selamat datang di Haleluya Store</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-lg-n10 mt-md-n11 mt-n10 d-flex justify-content-center align-items-center" style="min-height: 50vh;">
            <div class="card card-plain" style="width: 500px;">
                <div class="p-5">
                    @if(session()->has('pesan'))
                    <div class="alert alert-danger">
                        {{session()->get('pesan')}}
                    </div>
                    @endif

                    <form class="form" method="POST" action="{{route('auth.verify')}}">
                        @csrf
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-2">LOGIN</h1>
                        </div>
                        <span class="Mail" style="color: black;">E-Mail</span>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                        </div>
                        <span class="Password" style="color: black;">Password</span>
                        <div class="form-group">
                            <input type="password" name='password' class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                        </div>
                        <input type="submit" value="Login" class="login">
                        <p class="text-sm mt-0.2 mb-0">Belum punya akun? <a href="javascript:;" class="text-dark font-weight-bolder">Register</a></p>
                    </form>
                </div>
            </div>
        </div>
    </main>


    </main>
    <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->

    <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>
</body>

</html>