<?php
include('../db.php');

if (isset($_POST['save'])) {
    $fecha = $_POST['fecha'];
    $descripcion = $_POST['descripcion'];
    $tipoFeriado = $_POST['tipoFeriado'];

    $existingUserQuery = "EXEC paVerificarDiaFeriado @fecha = ?";
    $stmt = $conn->prepare($existingUserQuery);
    $stmt->bindParam(1, $fecha, PDO::PARAM_STR);
    $stmt->execute();
    $count = $stmt->fetchColumn();
    $stmt->closeCursor();

    if ($count > 0) {
        // El nombre de usuario ya existe
        $_SESSION['message_danger'] = 'Error, el dia feriado ingresado ya esta registrado.';
        $_SESSION['feriado_message'] = true;
        header('Location: ../index.php');
        exit();
    }else{

    $sql = "EXEC paInsertarDiasFeriado @fecha = :fecha, @descripcion = :descripcion, @tipoFeriado = :tipoFeriado";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':fecha', $fecha, PDO::PARAM_STR);
    $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
    $stmt->bindParam(':tipoFeriado', $tipoFeriado, PDO::PARAM_STR);
    $stmt->execute();
    if ($stmt->errorCode() === '00000') {
        $_SESSION['message'] = 'Se ha registrado con éxito';
        $_SESSION['message_type'] = 'success';
        $_SESSION['feriado_message'] = true;
        header('Location: ../index.php');
        exit();
    } else {
        $_SESSION['message'] = 'Error al registrar el dia feriado.';
        $_SESSION['message_type'] = 'danger';
        $_SESSION['feriado_message'] = true;
        header('Location: ../index.php');
        exit();
    }
    }
}
?>
