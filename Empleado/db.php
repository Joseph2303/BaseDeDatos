<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$host = 'localhost';
$dbname = 'proyecto_bd';
$username = 'Quintanilla';
$password = '1234';
$puerto = 1433;

try {
    $conn = new PDO("sqlsrv:Server=$host,$puerto;Database=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exp) {
    $exp->getMessage();
}
?>
