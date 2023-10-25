<?php
include("../db.php");

if (isset($_GET['idDiasFeriados'])) {
  $idDiasFeriados = $_GET['idDiasFeriados'];

    try {
        $query = "EXEC paEliminarDiasFeriados @idDiasFeriados=?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $idDiasFeriados, PDO::PARAM_INT);
        $stmt->execute();

        $_SESSION['message'] = 'Día feriado eliminado exitosamente';
        $_SESSION['message_type'] = 'success';
        $_SESSION['feriado_message'] = true;

        header('Location: ../index.php');
    } catch (PDOException $exp) {
        $_SESSION['message_danger'] = 'Error al eliminar el día feriado: ' . $exp->getMessage();
        header('Location: ../index.php');
    }
}
?>

