<?php
include('../db.php');

function guardarUsuario($username, $contrasena, $tipoUsuario)
{
    global $conn;
    
    $query = "EXEC paInsertarUsuario @username = ?, @contrasena = ?, @tipoUsuario = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $username, PDO::PARAM_STR);
    $stmt->bindParam(2, $contrasena, PDO::PARAM_STR);
    $stmt->bindParam(3, $tipoUsuario, PDO::PARAM_STR);
    $result = $stmt->execute();

    if ($result) {
        return true;
    } else {
        return false;
    }
}

if (isset($_POST['save'])) {
    $username = $_POST['username'];
    $contrasena = $_POST['contrasena'];
    $tipoUsuario = isset($_POST['tipoUsuario']) ? $_POST['tipoUsuario'] : 'empleado'; 

    $usuarioGuardado = guardarUsuario($username, $contrasena, $tipoUsuario);

    if ($usuarioGuardado) {
        $_SESSION['message'] = 'Usuario guardado con éxito';
        $_SESSION['message_type'] = 'success';
        $_SESSION['usuario_message'] = true;
        header('Location: ../index.php');
        exit();
    } else {
        $_SESSION['message'] = 'Error al guardar el usuario.';
        $_SESSION['message_type'] = 'danger';
        $_SESSION['usuario_message'] = true;
        header('Location: ../index.php');
        exit();
    }
}
?>



