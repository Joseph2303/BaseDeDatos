<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$host = 'tcp:hcrbd.database.windows.net';
$dbname = 'proyecto_bd';
$username = 'joseph';
$password = 'jos23032000';
$puerto = 1433;

try {
    $conn = new PDO("sqlsrv:Server=$host,$puerto;Database=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exp) {
    $exp->getMessage();
}
?>
