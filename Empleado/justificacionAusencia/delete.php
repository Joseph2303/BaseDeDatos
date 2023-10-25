<?php
include("../db.php");

if (isset($_GET['idJustificacionAusencia'])) {
  $idJustificacionAusencia = $_GET['idJustificacionAusencia'];

    try {
        $query = "EXEC paEliminarJustificacionAusencia @idJustificacionAusencia=?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $idJustificacionAusencia, PDO::PARAM_INT);
        $stmt->execute();

        $_SESSION['message'] = 'JustificacionAusencia eliminado exitosamente';
        $_SESSION['message_type'] = 'success';
        $_SESSION['jutificacion_message'] = true;

        header('Location: ../index.php');
    } catch (PDOException $exp) {
        $_SESSION['message_danger'] = 'Error al eliminar la justificacion: ' . $exp->getMessage();
        header('Location: ../index.php');
    }
}
?>


