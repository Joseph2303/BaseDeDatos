<?php
include("../db.php");

if (isset($_GET['puesto'])) {
  $puesto = $_GET['puesto'];

    try {
        $query = "EXEC paEliminarPuesto @puesto=?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $puesto, PDO::PARAM_INT);
        $stmt->execute();

        $_SESSION['message'] = 'Puesto eliminado exitosamente';
        $_SESSION['message_type'] = 'success';
        $_SESSION['puesto_message'] = true;
        //echo '<script>alert("Esto es un mensaje de alerta en PHP");</script>';       
        header('Location: ../index.php');
    } catch (PDOException $exp) {
        $_SESSION['message_danger'] = 'Error al eliminar el puesto: ' . $exp->getMessage();
        $_SESSION['message_type'] = 'danger';
        $_SESSION['puesto_message'] = true;
        header('Location: ../index.php');
    }
}
?>

