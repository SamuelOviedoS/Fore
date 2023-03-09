<?php

//Se requiere la conexión a la base de datos
require 'moodleconn.php';

// Iniciar sesión
session_start();

$user = "";
$password = "";
$registrado = false;
$error = "";
$typebtn = "";
$updpass = "";


if (session_status() === PHP_SESSION_ACTIVE) {
    if (isset($_SESSION['login'])) {
        // la sesión está activa
        if (isset($_SESSION['username']) && isset($_SESSION['passwd'])) {

            if (isset($_GET["updpass"])) {
                $updpass = $_GET["updpass"];
            }

            $user = $_SESSION['username'];
            $password = $_SESSION['passwd'];

            $pattern = "/(\w)-20\d+/";

            if (preg_match($pattern, $user)) {
                $texto = "Plataforma";
            } else {
                $texto = "Docente";
            }
            $minusculas = strtolower($user);
            $stmt = $db->prepare("SELECT * FROM public.mdl_user WHERE username = :usuario");
            $stmt->bindParam(':usuario', $minusculas);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$resultado) {
                $error = "Su usuario no se encuentra registrado en la plataforma de Moodle.";
            } else if ($resultado && password_verify($password, $resultado['password'])) {
                $typebtn = "submit";
            } else {
                $registrado = true;
                //$error = "Su contraseña aun no ha sido actualizada.";
                if ($updpass == "updready") {
                    $registrado = false;
                }

                //Hasta actualizar contraseña el estado cambiará
                //$typebtn = "submit";
            }
        }
    } else {
        // Eliminar todas las variables de sesión
        session_unset();

        // Destruir la sesión
        session_destroy();

        // Iniciar la sesión
        session_start();

        // Generar un nuevo sessid
        session_regenerate_id();

        // Redireccionar a la página de inicio de sesión
        header("Location: ../index.php");
        exit;
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
    <link rel="stylesheet" href="../css/dashStyles.css">
    <title>Panel</title>
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
            <div class="dropdown">
                <button class="dropbtn">
                    <img src="../resources/icon/userw.png" alt="user">
                    <span>
                        <?php echo $user ?>
                    </span>
                </button>
                <div class="dropdown-content">
                    <a href="#" id="close-session">Cerrar sesión</a>
                </div>
            </div>

        </div>
    </div>
    <div class="responsive">
        <div class="container">
            <?php
            if ($error !== "") {
                $typebtn = "reset";
            ?>
                <div class="error-content">
                    <p>
                        <?php
                        echo $error;
                        ?>
                    </p>
                </div>
            <?php }
            if ($registrado) {
            ?>
                <div class="content-validate">
                    <p>Su contraseña de Moodle debe ser actualizada:</p>
                    <button type="button" class="btnupd" id="upd-pwsd" onclick="updpassbtn()">
                        <span class="btn-text">Actualizar</span>
                        <span class="btn-icon">
                            <ion-icon name="refresh-circle-outline"></ion-icon>
                        </span>
                    </button>
                </div>
            <?php } ?>
            <div class="backg">
                <form action="http://192.168.20.163/moodle/login/index.php" method="post" id="login">
                    <input type="hidden" name="logintoken" value="{{logintoken}}" />
                    <div class="btn">
                        <input type="hidden" name="username" id="username" value="<?php echo $minusculas ?>">
                        <input type="hidden" name="password" id="password" value="<?php echo $password ?>">
                        <button class="btn1" id="btnMdl" type="<?php echo $typebtn ?>">
                            <div class="img-box">
                                <img src="../resources/icon/moodlew.png" alt="moodle">
                            </div>
                            <h3>Moodle</h3>

                        </button>
                    </div>
                </form>

                <div class="btn">
                    <button class="btn2" id="btnBibl" onclick="rediBlt()">
                        <div class="img-box">
                            <img src="../resources/icon/book.png" alt="libro">
                        </div>
                        <h3>Biblioteca</h3>
                    </button>
                </div>

                <div class="btn">
                    <button class="btn3" id="btnPlt">
                        <div class="img-box">
                            <img src="../resources/icon/userplat.png" alt="user">
                        </div>
                        <h3>
                            <?php echo $texto ?>
                        </h3>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <div class="all">
                <div class="izq">
                    <h3>Actualización exitosa</h3>
                    <p>Contraseña actualizada correctamente.</p>
                </div>
                <img src="https://thumbs.gfycat.com/QuaintLikelyFlyingfish-max-1mb.gif" alt="check">
                <div class="der">
                    <span class="close">&times;</span>
                </div>
            </div>
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
                    <img src="../resources/icon/twitter.png" alt="twitter-icon">
                </a>
                <a href="https://www.facebook.com/UNACIFORHN" class="social-ico">
                    <img src="../resources/icon/facebook.png" alt="facebook-icon">
                </a>
                <a href="https://www.youtube.com/channel/UCcoa_0FU0eLKJBR7nudKo_Q" class="social-ico">
                    <img src="../resources/icon/youtube.png" alt="youtube-icon">
                </a>
                <a href="https://www.instagram.com/accounts/login/?next=/unaciforhn/" class="social-ico">
                    <img src="../resources/icon/instagram.png" alt="instagram-icon">
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
        var close = document.getElementById("close-session");
        // Agregar un controlador de eventos para el evento "click"
        close.addEventListener("click", function(evento) {
            // Prevenir la acción predeterminada del enlace
            evento.preventDefault();
            // Hacer una solicitud AJAX al archivo PHP
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Mostrar el resultado en la página
                    window.location.href = this.responseText;
                }
            };
            xhttp.open("GET", "closess.php", true);
            xhttp.send();

        })

        function updpassbtn() {
            // Get the modal
            var modal = document.getElementById("myModal");
            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // var upd = document.getElementById("upd-pwsd");
            var usuario = document.getElementById("username").value;
            var contrasena = document.getElementById("password").value;

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText !== "Actualizada") {
                        alert("No se actualizó la contraseña." + "debido a que: " + this.responseText);
                    } else {
                        modal.style.display = "block";
                    }
                }
            };
            xhttp.open("POST", "updpasswd.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            var datos = "usuario=" + usuario + "&contrasena=" + contrasena;
            xhttp.send(datos);

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
                var varUpd = "updready";
                window.location.href = window.location.href + "?updpass=" + varUpd;
            }
        }

        function rediBlt() {
            window.location.href = "http://192.168.20.210";

        }

        function rediPlat() {
            window.location.href = "https://erp.unacifor.edu.hn/login";

        }
    </script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>