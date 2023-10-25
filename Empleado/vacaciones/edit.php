<?php
include("../db.php");

$idVacaciones = '';
$periodo = '';
$dispoble = '';
$diasAsig = '';
$idEmpleado = '';

if (isset($_GET['idVacaciones'])) {
  $idVacaciones = $_GET['idVacaciones'];
  $query = "EXEC paBuscarVacacionesPorID @idVacaciones=?";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(1, $idVacaciones, PDO::PARAM_INT);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($row) {
    $periodo = $row['periodo'];
    $dispoble = $row['dispoble'];
    $diasAsig = $row['diasAsig'];
    $idEmpleado = $row['idEmpleado'];
  }
}

if (isset($_POST['update'])) {
    $periodo = $_POST['periodo'];
    $dispoble = $_POST['dispoble'];
    $diasAsig = $_POST['diasAsig'];
    $idEmpleado = $_POST['idEmpleado'];

  $query = "EXEC paActualizarVacaciones @periodo=?, @dispoble=?, @diasAsig=?, @idEmpleado=?";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(1, $periodo, PDO::PARAM_INT);
  $stmt->bindParam(2, $dispoble, PDO::PARAM_STR);
  $stmt->bindParam(3, $diasAsig, PDO::PARAM_STR);
  $stmt->bindParam(4, $idEmpleado, PDO::PARAM_INT);
  $stmt->execute();

  $_SESSION['message'] = 'Vacaciones actualizada exitosamente';
  $_SESSION['message_type'] = 'success';
  $_SESSION['vacaciones_message'] = true;
  header('Location: ../index.php');
  exit();
}
?>
