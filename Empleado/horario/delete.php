<?php
include("../db.php");

if (isset($_GET['idHorario'])) {
  $idHorario = $_GET['idHorario'];

  try {
    $query = "EXEC paEliminarHorario @idHorario = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $idHorario, PDO::PARAM_INT);
    $stmt->execute();

    $_SESSION['message'] = 'Horario eliminado exitosamente';
    $_SESSION['message_type'] = 'danger';
    header('Location: ../viewsEmpleados/horario.php');
  } catch (PDOException $exp) {
    $_SESSION['message_danger'] = 'Error al eliminar el horario: ' . $exp->getMessage();
    header('Location: ../viewsEmpleados/horario.php');
  }
}
?>


