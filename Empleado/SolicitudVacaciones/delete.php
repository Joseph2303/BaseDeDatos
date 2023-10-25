<?php
include("../db.php");

if (isset($_GET['idSolicitudVacaciones'])) {
  $idSolicitudVacaciones = $_GET['idSolicitudVacaciones'];

      try {
          $query = "EXEC paEliminarSolicitudVacaciones @idSolicitudVacaciones=?";
          $stmt = $conn->prepare($query);
          $stmt->bindParam(1, $idSolicitudVacaciones, PDO::PARAM_INT);
          $stmt->execute();
  
          $_SESSION['message'] = 'Solicitud eliminada exitosamente';
          $_SESSION['message_type'] = 'success';
          $_SESSION['encargado_solicitud']=true;
  

          header('Location: ../index.php');
      } catch (PDOException $exp) {
          $_SESSION['message_danger'] = 'Error al eliminar la solicitud: ' . $exp->getMessage();
          $_SESSION['encargado_solicitud']=true;
          header('Location: ../index.php');
    }  
}
?>
