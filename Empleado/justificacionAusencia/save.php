<?php
include('../db.php');
if (isset($_POST['save'])) {
    $idJustificacionAusencia = '';
    $fechaSolicitud ='';
    $fechaAusencia = $_POST['fechaAusencia'];
    $archivos = $_POST['archivos'];
    $justificacion = $_POST['justificacion'];
    $estado = '';
    $descripcion = '';
    $nombreEncargado = '';
    $idEmpleado = $_POST['idEmpleado'];

    $fechaSolicitud = date('Y-m-d');


  $existingUserQuery = "EXEC paVerificarJustificacionAusencia @fechaAusencia = ?, @idEmpleado=? ";
  $stmt = $conn->prepare($existingUserQuery);
  $stmt->bindParam(1, $fechaAusencia, PDO::PARAM_STR);
  $stmt->bindParam(2, $idEmpleado, PDO::PARAM_INT);
  $stmt->execute();
  $count = $stmt->fetchColumn();
  $stmt->closeCursor();


  if ($count > 0) {
    $_SESSION['message_danger'] = 'Error, la justificacion ya esta registrada.';
    $_SESSION['message_type'] = 'danger';
    $_SESSION['justificaion_message'] = true;
    header('Location: ../index.php');
    exit();
  }else{


    $sql = "EXEC paInsertarJustificacionAusencia @fechaSolicitud = :fechaSolicitud, @fechaAusencia = :fechaAusencia, @justificacion = :justificacion, @estado = :estado, @descripcion = :descripcion, @nombreEncargado = :nombreEncargado, @idEmpleado = :idEmpleado";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':fechaSolicitud', $fechaSolicitud, PDO::PARAM_STR);
    $stmt->bindParam(':fechaAusencia', $fechaAusencia, PDO::PARAM_STR);
    $stmt->bindParam(':justificacion', $justificacion, PDO::PARAM_STR);
    $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);
    $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
    $stmt->bindParam(':nombreEncargado', $nombreEncargado, PDO::PARAM_STR);
    $stmt->bindParam(':idEmpleado', $idEmpleado, PDO::PARAM_STR);

    $stmt->execute();
    if($stmt->errorCode() === '00000'){
      $_SESSION['message'] = 'Su justificacion se ha registrado con exito';
      $_SESSION['message_type'] = 'success';
      $_SESSION['justificaion_message'] = true;
      header('Location: ../index.php');
      exit();

    }else{
      $_SESSION['message'] = 'Error al ingresar la justificacion';
      $_SESSION['message_type'] = 'danger';
      $_SESSION['justificaion_message'] = true;
      header('Location: ../index.php');
      exit();
      
    }

  }
}
?>

