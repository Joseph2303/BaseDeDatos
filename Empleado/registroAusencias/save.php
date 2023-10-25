<?php
include('../db.php');

if (isset($_POST['save'])) {
    $fechaAusencia = $_POST['fechaAusencia'];
    $archivos = $_POST['archivos'];
    $justificacion = $_POST['justificacion'];
    $idEmpleado = $_POST['idEmpleado'];

    $fechaSolicitud = date('Y-m-d');

    $sqlInsert = "INSERT INTO JustificiacionAusencias (fechaAusencia, archivos, justificacion, idEmpleado) VALUES (?, ?, ?, ?)";
    $stmtInsert = $conn->prepare($sqlInsert);
    $stmtInsert->bindParam(1, $fechaAusencia, PDO::PARAM_STR);
    $stmtInsert->bindParam(2, $archivos, PDO::PARAM_STR);
    $stmtInsert->bindParam(3, $justificacion, PDO::PARAM_STR);
    $stmtInsert->bindParam(4, $idEmpleado, PDO::PARAM_INT);

    if ($stmtInsert->execute()) {
        $_SESSION['message'] = 'Su justificación se ha registrado con éxito';
        $_SESSION['message_type'] = 'success';
        $_SESSION['justificaion_message'] = true;
        header('Location: ../index.php');
        exit();
    } else {
     
        $_SESSION['message'] = 'Error al ingresar la justificación';
        $_SESSION['message_type'] = 'danger';
        $_SESSION['justificaion_message'] = true;
        header('Location: ../index.php');
        exit();
    }
} elseif (isset($_POST['crearRegistro'])) {
    $sqlInsertAuto = "INSERT INTO JustificiacionAusencias (fechaAusencia, archivos, justificacion, idEmpleado) VALUES (CURRENT_DATE, 'archivos_automaticos', 'Justificación automática', 1)";
    $stmtInsertAuto = $conn->prepare($sqlInsertAuto);

    if ($stmtInsertAuto->execute()) {
   
        $_SESSION['message'] = 'Registro automático exitoso';
        $_SESSION['message_type'] = 'success';
        $_SESSION['justificaion_message'] = true;
        header('Location: ../index.php');
        exit();
    } else {
        
        $_SESSION['message'] = 'Error al ingresar el registro automático';
        $_SESSION['message_type'] = 'danger';
        $_SESSION['justificaion_message'] = true;
        header('Location: ../index.php');
        exit();
    }
}
?>
