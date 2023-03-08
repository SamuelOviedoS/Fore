<?php

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
    <link rel="stylesheet" href="./css/styles.css">
    <title>Inicio de Sesión</title>
</head>

<body>
    <div class="header">
        <div class="displayflex">
            <span class="site-logo-img">
                <a href="https://unacifor.edu.hn/">
                    <img src="https://erp.unacifor.edu.hn/img/logout.png" alt="siteLogo">
                </a>
            </span>
            <h2>
                UNACIFOR | SIU
            </h2>
        </div>
    </div>

    <div class="container">
        <div class="login-box">
            <h2>Inicio de Sesión</h2>
            <form action='./panel/index.php' class='form' method="post">
                <div class="user-box">
                    <input type="text" id="user" name="user" required="">
                    <label>Usuario</label>
                </div>
                <div class="user-box">
                    <input type="password" id="password" name="password" required="">
                    <label>Contraseña</label>
                </div>

                <button type="submit" class='btn'><span>Acceder</span></button>

                <a href="./passwordreset/passwordreset.php">¿Olvidaste tu contraseña?</a>
            </form>
        </div>
    </div>

    <footer>
        <div class="content">
            <div class="aprende">
                <div class="center">
                    <img src="https://erp.unacifor.edu.hn/img/logout.png" alt="siteLogo">
                </div>
                <p>Aprende produciendo</p>
            </div>
            <div class="info">
                <div class="titulo">
                    <h3>Escríbenos</h3>
                </div>
                <div class="correos">
                    <p>recursoshumanos@unacifor.edu.hn</p>
                    <p>unidadesproductivas@unacifor.edu.hn</p>
                    <p>dir.protocoloycomunicaciones@unacifor.edu.hn</p>
                    <p>secretaria_registro@unacifor.edu.hn</p>
                    <p>admisiones@unacifor.edu.hn</p>
                </div>
            </div>
        </div>
        <hr size="1px">
        <div class="copyright">
            <p>Copyright © 2023 | Diseñado por UNACIFOR</p>
        </div>
    </footer>

</body>

</html>