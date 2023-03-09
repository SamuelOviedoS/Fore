<?php

//Se requiere la conexión a la base de datos
require './dash/conn.php';

$errorusr = "";
$errorpsw = "";
$error = "";
$errormdl = "";

// Iniciar la sesión
session_start();

if (isset($_GET["errorcode"])) {
    $errorcode = $_GET["errorcode"];

    switch ($errorcode) {
        case 1:
            $errormdl = "Error de servidor. Por favor intente de nuevo más tarde.";
            break;
        case 2:
            $errormdl = "Error de entrada inválida. Por favor revise los datos ingresados.";
            break;
        case 3:
            $errormdl = "Error de autenticación. Por favor inicie sesión de nuevo";
            break;

        case 7:
            $errormdl = "Error de autenticación. Usuario no registrado en la plataforma Moodle.";
            break;

        default:
            $errormdl = "Error desconocido.";
            break;
    }
}

// Comprobar si se ha enviado el formulario:
if (!empty($_POST)) {
    // Comprobar si se han enviado las variables necesarios
    if (isset($_POST['username']) && isset($_POST['password'])) {

        $user = $_POST['username'];
        $passwd = $_POST['password'];
        if ($user == "") {
            $errorusr = "Ingrese su nombre de usuario";
        } else if ($passwd == "") {
            $errorpsw = "Ingrese su contraseña";
        } else {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $stmt = $db->prepare("SELECT username, password FROM public.users WHERE username = :username");
                $stmt->bindParam(':username', $user);
                $stmt->execute();
                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($resultado && password_verify($passwd, $resultado['password'])) {
                    // La contraseña es correcta, el usuario está autenticado
                    $dbh = null;

                    //Guardar el nombre de usuario en una variable de sesión
                    $_SESSION['username'] = $user;
                    $_SESSION['passwd'] = $resultado['password']; //$passwd;
                    $_SESSION['login'] = true;
                    header("Location: ./dash/index.php");
                    exit;
                } else {
                    // La contraseña es incorrecta, el usuario no está autenticado
                    $error = "Usuario o contraseña incorrecto";
                }
            }
        }
    } else {
        $error = "Ingrese los datos requeridos";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans&display=swap');
    </style>
    <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Inicio de Sesión</title>
    <link rel="shortcut icon" href="https://erp.unacifor.edu.hn/img/logout.png">
</head>

<body>
    <div class="header">
        <div class="displayflex">
            <div class="item">
                <div>
                    <span class="site-logo-img">
                        <a href="https://unacifor.edu.hn/">
                            <img src="https://erp.unacifor.edu.hn/img/logout.png" alt="siteLogo">
                        </a>
                    </span>
                </div>
                <div>
                    <h2>
                        UNACIFOR | SIU
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="errormdl-content">
            <p>
                <?php
                echo $errormdl;
                ?>
            </p>
        </div>
        <div class="session">
            <div class="left">
            </div>
            <form action="index.php" method="post" id="login">
                <input type="hidden" name="logintoken" value="{{logintoken}}" />
                <h4>Inicio de sesión <span>Fore ID</span></h4>
                <div class="floating-label">
                    <input placeholder="Usuario" type="text" name="username" id="username" autocomplete="off">
                    <label for="username">Usuario:</label>
                    <div class="icon">
                        <img src="./resources/icon/user.png" alt="user">
                    </div>
                </div>
                <div class="error-content">
                    <p>
                        <?php
                        echo $errorusr;
                        ?>
                    </p>
                </div>
                <div class="floating-label">
                    <input placeholder="Contraseña" type="password" name="password" id="password" autocomplete="off">
                    <label for="password">Contraseña:</label>
                    <i class="far fa-eye" id="show-password"></i>
                    <div class="icon">
                        <img src="./resources/icon/lock.png" alt="lock">
                    </div>
                </div>
                <div class="error-content">
                    <p>
                        <?php
                        echo $errorpsw;
                        ?>
                    </p>
                    <p>
                        <?php
                        echo $error;
                        ?>
                    </p>
                </div>
                <a class="a_color" href="./dash/passwordreset.php">¿Olvidaste tu
                    contraseña?</a>
                <button type="submit" id="loginbtn">Acceder</button>
            </form>
        </div>
    </div>

    <footer>
        <div class="content">
            <div class="aprende">
                <div class="center">
                    <img src="https://erp.unacifor.edu.hn/img/logout.png" alt="siteLogo">
                </div>
                <div class="texto">
                    <p>Aprende produciendo</p>
                </div>
            </div>
            <div class="redes">
                <h3>Nuestras redes</h3>
                <a href="https://twitter.com/unaciforhn" class="social-ico">
                    <img src="./resources/icon/twitter.png" alt="twitter-icon">
                </a>
                <a href="https://www.facebook.com/UNACIFORHN" class="social-ico">
                    <img src="./resources/icon/facebook.png" alt="facebook-icon">
                </a>
                <a href="https://www.youtube.com/channel/UCcoa_0FU0eLKJBR7nudKo_Q" class="social-ico">
                    <img src="./resources/icon/youtube.png" alt="youtube-icon">
                </a>
                <a href="https://www.instagram.com/accounts/login/?next=/unaciforhn/" class="social-ico">
                    <img src="./resources/icon/instagram.png" alt="instagram-icon">
                </a>
            </div>
        </div>
        <div>
            <hr size="1px">
            <div class="copyright">
                <p>Copyright © 2023 | Diseñado por UNACIFOR</p>
            </div>
        </div>

    </footer>
    <script>
        const showPasswordButton = document.getElementById('show-password');
        const passwordInput = document.getElementById('password');

        showPasswordButton.addEventListener('click', function() {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                showPasswordButton.classList.remove('fa-eye');
                showPasswordButton.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                showPasswordButton.classList.remove('fa-eye-slash');
                showPasswordButton.classList.add('fa-eye');
            }
        });
    </script>
</body>

</html>