<?php
define('DB_HOST', 'localhost');
define('DB_PORT', '5432');
define('DB_NAME', 'moodle');
define('DB_USER', 'moodleuser');
define('DB_PASSWORD', 'moodle2023');

try {
    $db = new PDO("pgsql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error al conectar: " . $e->getMessage();
}
?>