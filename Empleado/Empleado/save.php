<?php
include('../db.php');

if (isset($_POST['save'])) {
    $nombre = $_POST['nombre'];
    $apellido1 = $_POST['apellido1'];
    $apellido2 = $_POST['apellido2'];
    $email = $_POST['email'];
    $fechContrat = $_POST['fechContrat'];
    $idUsuario = $_POST['idUsuario'];

    // Verificar si el nombre de usuario existe en la tabla usuario
    $check_query = "SELECT * FROM usuario WHERE idUsuario = ?";
    $stmt_check = $conn->prepare($check_query);
    $stmt_check->execute([$idUsuario]);

    if ($stmt_check->rowCount() == 0) {
        // El nombre de usuario no existe, mostrar mensaje de error personalizado
        $error_message = "El nombre de usuario '$idUsuario' no existe. Por favor, verifica el nombre de usuario.";

        session_start();
        $_SESSION['idUsuario_error'] = $error_message;
        $_SESSION['empleado_message'] = true;
        header("Location: ../index.php");
        exit();
    }

    // El nombre de usuario existe, continuar con la inserción del empleado
    $query = "INSERT INTO empleado (nombre, apellido1, apellido2, email, fechContrat,  idUsuario) 
              VALUES ( ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->execute([$nombre, $apellido1, $apellido2, $email, $fechContrat, $idUsuario]);

    session_start();
    $_SESSION['message'] = 'Empleado guardado exitosamente';
    $_SESSION['message_type'] = 'success';
    $_SESSION['empleado_message'] = true;
    header('Location: ../index.php');
}
?>
