<?php
include("../db.php");

if (isset($_GET['idUsuario'])) {
  $idUsuario = $_GET['idUsuario'];

    try {
        $query = "EXEC paEliminarUsuario @idUsuario=?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $idUsuario, PDO::PARAM_INT);
        $stmt->execute();
        
        $_SESSION['message'] = 'Usuario eliminado exitosamente';
        $_SESSION['message_type'] = 'danger';
        $_SESSION['usuario_message'] = true;
        header('Location: ../index.php');
        exit();
    } catch (PDOException $exp) {
        $_SESSION['message'] = 'Error al eliminar el usuario' . $exp->getMessage();
        $_SESSION['message_type'] = 'danger';
        $_SESSION['usuario_message'] = true;
        header('Location: ../index.php');
        exit();
    }
}
?>




