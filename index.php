<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Login | SysPro</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition" style="background-color: cadetblue;">
    <div class="page-wrapper">
        <div class="page-content--bge5" style="background-image: radial-gradient(circle, skyblue, green );">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content" style="background-color: darkslategrey;">
                        <div class="login-logo">
                            <a href="#">
                                <img src="images/icon/logo.png" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="login-form">
                            <?php
                            // Mostrar alertas basadas en el valor de 'alert' en la URL
                                    if (isset($_GET['alert'])) {
                                        $alert = $_GET['alert'];
                                        if ($alert == 1) {
                                            echo "<div class='alert alert-danger alert-dismissable'>
                                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                            <h4><i class='icon fa fa-times-circle'></i> Error!</h4>
                                            Usuario o contraseña incorrectos, por favor intente nuevamente.
                                            </div>";
                                        } elseif ($alert == 2) {
                                            echo "<div class='alert alert-success alert-dismissable'>
                                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                            <h4><i class='icon fa fa-check-circle'></i> Exito!</h4>
                                            Has cerrado sesión con éxito.
                                            </div>";
                                        } elseif ($alert == 3) {
                                            echo "<div class='alert alert-warning alert-dismissable'>
                                            <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                            <h4><i class='icon fa fa-exclamation-circle'></i> Atención!</h4>
                                            Debes ingresar un usuario y contraseña para acceder.
                                            </div>";
                                        }
                                    }
                            ?>
                            <form action="login-check.php" method="POST">
                                <div class="form-group">
                                    <label for="username">Usuario</label>
                                    <input type="text" class="au-input au-input--full" name="username" id="username" placeholder="Username" autocomplete="off" required />
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="au-input au-input--full" name="password" id="password" placeholder="Password" required />
                                </div>
                                <div class="login-checkbox">
                                    <label>
                                        <input type="checkbox" name="recordar">Recordar contraseña
                                    </label>
                                    <label>
                                        <a href="recuperar_contraseña.html">¿Has olvidado tu contraseña?</a>
                                    </label>
                                </div>
                                <button class="au-btn au-btn--block au-btn--green m-b-10" type="submit">Iniciar Sesión</button>
                            </form>
                            <div class="register-link">
                                <p>No tienes una cuenta? <a href="#">Registrate aquí</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS -->
    <script src="vendor/slick/slick.min.js"></script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js"></script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>

    <!-- Main JS-->
    <script src="js/main.js"></script>

</body>

</html>
