<?php

require '.moodleconn.php';

// Comprobar si se han enviado las variables necesarios
if (isset($_POST['usuario']) && isset($_POST['contrasena'])) {
    $username = $_POST["usuario"];
    $passwd = $_POST["contrasena"];

    if ($username !== "" && $passwd !== "") {
        $password = password_hash($passwd, 1, ['cost' => 10]);
        //UPDATE public.mdl_user SET password=? WHERE username = ;
        $stmt = $db->prepare("UPDATE public.mdl_user SET password = :passwd WHERE username = :user");
        $stmt->bindParam(':user', $username);
        $stmt->bindParam(':passwd', $password);
        $stmt->execute();

        $stmt = $db->prepare("SELECT username, password FROM public.mdl_user WHERE username = :user AND password = :passwd");
        $stmt->bindParam(':user', $username);
        $stmt->bindParam(':passwd', $password);
        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            echo "Actualizada";
        } else {
            echo "No se encontró ningún usuario con los valores recibidos.";
        }
    } else {
        echo "Las variables estan vacias.";
    }
} else {
    echo "Las variables no se recibieron.";
}

?>