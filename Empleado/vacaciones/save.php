<?php
include('../db.php');

if (isset($_POST['save'])) {
    $periodo = $_POST['periodo'];
    $dispoble = $_POST['dispoble'];
    $diasAsig = $_POST['diasAsig'];
    $idEmpleado = $_POST['idEmpleado'];


    $query = "EXEC paVerificarVacaciones @ = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $periodo, PDO::PARAM_INT);
    $stmt->bindParam(2, $dispoble, PDO::PARAM_STR);
    $stmt->bindParam(3, $diasAsig, PDO::PARAM_STR);
    $stmt->bindParam(4, $idEmpleado, PDO::PARAM_INT);
    $stmt->execute();
    $count = $stmt->fetchColumn();
    $stmt->closeCursor();

    if ($count > 0) {
        // El nombre de usuario ya existe
        $_SESSION['message_danger'] = 'Error, las vacaciones ingresadas ya estan registradas.';
        $_SESSION['vacaciones_message'] = true;
        header('Location: ../index.php');
        exit();
    }else{

    $sql = "EXEC paInsertarVaciones @periodo = :periodo, @dispoble = :dispoble, @diasAsig = :diasAsig, @idEmpleado = :idEmpleado";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':periodo', $periodo, PDO::PARAM_STR);
    $stmt->bindParam(':dispoble', $dispoble, PDO::PARAM_STR);
    $stmt->bindParam(':diasAsig', $diasAsig, PDO::PARAM_STR);
    $stmt->bindParam(':idEmpleado', $idEmpleado, PDO::PARAM_INT);
    $stmt->execute();
    if ($stmt->errorCode() === '00000') {
        $_SESSION['message'] = 'Se ha registrado con éxito';
        $_SESSION['message_type'] = 'success';
        $_SESSION['vacaciones_message'] = true;
        header('Location: ../index.php');
        exit();
    } else {
        $_SESSION['message'] = 'Error al registrar el vaciones.';
        $_SESSION['message_type'] = 'danger';
        $_SESSION['vaciones_message'] = true;
        header('Location: ../index.php');
        exit();
    }
    }
}
?>
