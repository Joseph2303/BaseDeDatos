<?php
include("../db.php");

if (isset($_GET['idVacaciones'])) {
  $idVacaciones = $_GET['idVacaciones'];

      try {
          $query = "EXEC paEliminarVacaciones @idVacaciones=?";
          $stmt = $conn->prepare($query);
          $stmt->bindParam(1, $idVacaciones, PDO::PARAM_INT);
          $stmt->execute();
  
          $_SESSION['message'] = 'Vacaciones eliminada exitosamente';
          $_SESSION['message_type'] = 'success';
          $_SESSION['vacaciones']=true;
  
          header('Location: ../index.php');
      } catch (PDOException $exp) {
          $_SESSION['message_danger'] = 'Error al eliminar las vacaciones: ' . $exp->getMessage();
          $_SESSION['vacaciones']=true;
          header('Location: ../index.php');
    }  
}
?>
