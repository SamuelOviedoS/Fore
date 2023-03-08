<?php
// Iniciar la sesión
session_start();

// Eliminar todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();

// Iniciar la sesión
session_start();

// Generar un nuevo sessid
session_regenerate_id();

// Redireccionar a la página de inicio de sesión
echo "../index.php";

?>