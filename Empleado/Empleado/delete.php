<?php
include("../db.php");

if (isset($_GET['idEmpleado'])) {
  $idEmpleado = $_GET['idEmpleado'];

    try {
        $query = "EXEC paEliminarEmpleado @idEmpleado=?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $idEmpleado, PDO::PARAM_INT);
        $stmt->execute();

        $_SESSION['message'] = 'Empleado eliminado exitosamente';
        $_SESSION['message_type'] = 'success';
        $_SESSION['empleado_message']=true;
        header('Location: ../index.php');

        header('Location: ../index.php');
    } catch (PDOException $exp) {
        $_SESSION['message_danger'] = 'Error al eliminar el día feriado: ' . $exp->getMessage();
        header('Location: ../index.php');
    }
}
?>

