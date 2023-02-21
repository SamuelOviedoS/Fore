<?php

// Obtener los datos enviados por el formulario
$username = $_POST['user'];
$email = $_POST['password'];

$rol = "Docente";

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
                    <img src="../resources/icon/user.png" alt="user">
                    <?php echo $username ?>
                </button>
                <div class="dropdown-content">
                    <a href="#">Cambiar contraseña</a>
                    <a href="#">Cerrar sesión</a>
                </div>
            </div>

        </div>
    </div>
    <div class="responsive">
        <div class="container">
            <div class="separate">
                <div class="card">
                    <a href="http://192.168.20.97/moodle/login/index.php">
                        <div class="imgBx">
                            <img src="../resources/img/moodle.png" alt="moodle">
                        </div>
                        <div class="contentBx">
                            <h2>Moodle</h2>
                        </div>
                    </a>
                </div>
            </div>
            <div class="separate">
                <div class="card2">
                    <a href="#">
                        <div class="imgBx">
                            <img src="../resources/img/libros.png" alt="books">
                        </div>
                        <div class="contentBx">
                            <h2>Biblioteca</h2>
                        </div>
                    </a>
                </div>
            </div>
            <div class="separate">
                <div class="card3">
                    <a href="https://erp.unacifor.edu.hn">
                        <div class="imgBx">
                            <img src="../resources/img/laptop.png" alt="platform">
                        </div>
                        <div class="contentBx">
                            <?php if ($rol == 'Estudiante'): ?>
                                <h2>Plataforma</h2>
                            <?php else: ?>
                                <h2>Docente</h2>
                            <?php endif; ?>
                        </div>
                    </a>
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