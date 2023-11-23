<?php
include('../db.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if ($data['action'] === 'realizarBackup') {
        $sql = "EXEC paCrearRespaldo";

        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            echo json_encode(array("status" => "error", "message" => "Error al preparar el procedimiento almacenado"));
            exit();
        }

        $result = $stmt->execute();

        if ($result === false) {
            echo json_encode(array("status" => "error", "message" => "Error al ejecutar el procedimiento almacenado"));
            exit();
        }

        $stmt->closeCursor();

        echo json_encode(array("status" => "success", "message" => "Backup realizado con éxito"));
        exit();
    }
}
?>
