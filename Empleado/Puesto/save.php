<?php
include('../db.php');

if (isset($_POST['save'])) {
    $puesto = $_POST['puesto'];

    $query = "EXEC paVerificarPuesto @puesto = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $puesto, PDO::PARAM_STR);
    $stmt->execute();
    $count = $stmt->fetchColumn();
    $stmt->closeCursor();

    if ($count > 0) {
        $_SESSION['message_danger'] = 'Error, el puesto ingresado ya esta registrado.';
        $_SESSION['puesto_message'] = true;
        header('Location: ../index.php');
        exit();
    }else{

    $sql = "EXEC paInsertarPuesto @puesto = :puesto";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':puesto', $puesto, PDO::PARAM_STR);
    $stmt->execute();
    if ($stmt->errorCode() === '00000') {
        $_SESSION['message'] = 'Se ha registrado con éxito';
        $_SESSION['message_type'] = 'success';
        $_SESSION['puesto_message'] = true;
        header('Location: ../index.php');
        exit();
    } else {
        $_SESSION['message'] = 'Error al registrar el puesto.';
        $_SESSION['message_type'] = 'danger';
        $_SESSION['puesto_message'] = true;
        header('Location: ../index.php');
        exit();
    }
    }
}
?>
