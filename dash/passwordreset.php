<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito+Sans&display=swap');
    </style>
    <link rel="stylesheet" href="../css/passwd.css">
    <title>Soporte</title>
    <link rel="shortcut icon" href="https://erp.unacifor.edu.hn/img/logout.png">
</head>

<body>
    <div class="header">
        <div class="displayflex">
            <div class="item">
                <div>
                    <span class="site-logo-img">
                        <a href="https://unacifor.edu.hn/">
                            <img src="https://erp.unacifor.edu.hn/img/logout.png" alt="siteLogo" />
                        </a>
                    </span>
                </div>
                <div>
                    <h2>UNACIFOR | SIU</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="responsive">
        <div class="container">
            <div class="cont text-content">
                <h3>Contactanos</h3>
                <p>
                    <strong>Si no recuerdas tu contraseña</strong>, favor ponerse en
                    contacto con soporte técnico.
                </p>
                <a href="https://mail.google.com/mail/?view=cm&to=soporte@unacifor.edu.hn&su=Restablecimiento%20de%20contraseña&body=Hola,%20he%20perdido%20mi%20contraseña%20mi%20usuario%20es:">Enviar correo a:
                    <strong>soporte@unacifor.edu.hn</strong>
                </a>
                <div class="content-btn">
                    <button type="button" class="btnupd" id="upd-pwsd" onclick="back()">
                        <span class="btn-icon">
                            <ion-icon name="arrow-back-circle-outline"></ion-icon>
                        </span>
                        <span class="btn-text">Volver</span>
                    </button>
                </div>
            </div>
            <div class="cont img-content">
                <img src="../resources/img/support.jpg" alt="support" />
            </div>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script>
        function back() {
            window.location.href = "../index.php";

        }
    </script>
</body>

</html>