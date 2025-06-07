<?php
$host = '127.0.0.1';  // O 'localhost'
$dbname = 'goalst';   // Reemplázalo con el nombre de tu BD
$username = 'root';   // Usuario de MySQL
$password = '';       // Si tienes clave, ponla aquí

try {
    // Crea la conexión usando PDO
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Mensaje opcional para pruebas
    // echo "Conexión exitosa"; 
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
