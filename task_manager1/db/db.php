<?php
$host = 'localhost';
$db = 'task_manager';
$user = 'root';  // Cambia si tienes una configuración distinta
$pass = '';      // Cambia si tienes una contraseña en tu XAMPP

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}
?>
