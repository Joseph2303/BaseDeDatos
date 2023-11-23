<?php
include("../db.php");

if (isset($_GET['idJustificacionTardia'])) {
    $idJustificacionTardia = $_GET['idJustificacionTardia'];

    try {
        $query = "DELETE FROM justificacionTardia WHERE idJustificacionTardia = :idJustificacionTardia";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $idJustificacionTardia, PDO::PARAM_INT);
        $stmt->execute();

        $_SESSION['message'] = 'Justificacion eliminado exitosamente';
        $_SESSION['message_type'] = 'success';
        $_SESSION['jutificacion_message'] = true;

        header('Location: ../index.php');
    } catch (PDOException $exp) {
        $_SESSION['message_danger'] = 'Error al eliminar la justificacion: ' . $exp->getMessage();
        header('Location: ../index.php');
    }
}
