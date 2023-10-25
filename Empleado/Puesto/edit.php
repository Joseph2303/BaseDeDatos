<?php
include("../db.php");

$puesto = '';
$idEmpleado = '';

if (isset($_GET['id'])) {
  $idPuesto= $_GET['id'];
  $query = "EXEC paBuscarPuestoPorID @puesto=?";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(1, $idPuesto, PDO::PARAM_INT);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($row) {
    $puesto = $row['puesto'];
    $idEmpleado = $row['idEmpleado'];
  }
  
}

if (isset($_POST['update'])) {
  $puesto = $_POST['puesto'];
  $idEmpleado = $_POST['idEmpleado'];


  $query = "EXEC paActualizarDiasFeriado @puesto=?, @idEmpleado=?";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(1, $puesto, PDO::PARAM_INT);
  $stmt->bindParam(2, $idEmpleado, PDO::PARAM_STR);
  $stmt->execute();

  $_SESSION['message'] = 'Puesto actualizado exitosamente';
  $_SESSION['message_type'] = 'success';
  $_SESSION['puesto_message'] = true;
  header('Location: ../index.php');
  exit();
}
?>
