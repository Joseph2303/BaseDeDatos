<?php
include('../db.php');

if (isset($_POST['save'])) {
    $idEmpleado = $_POST['idEmpleado'];

    // Ajustar la zona horaria a Costa Rica
    date_default_timezone_set('America/Costa_Rica');

    // Obtener la fecha y hora actual
    $horaInicio = date('h:i:s A');
    $fecha = date('Y-m-d');

    if (!existsEmpleado($idEmpleado)) {
        // El ID del empleado no existe
        $_SESSION['message_entrada'] = 'Error, el ID del empleado no existe en la base de datos.';
        $_SESSION['message_type_entrada'] = 'danger';
        header('Location: ../index.php');
        $_SESSION['horario_saved'] = true;
        exit();
    }

    if (existsHorario($fecha, $idEmpleado)) {
        // El registro ya existe
        $_SESSION['message_entrada'] = 'Ya se registró la marca.';
        $_SESSION['message_type_entrada'] = 'danger';
    } else {
        // Insertar el nuevo registro usando el procedimiento almacenado
        $query = "EXEC paInsertarHorario @horaInicio=?, @horaFin=NULL, @fecha=?, @idEmpleado=?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $horaInicio, PDO::PARAM_STR);
        $stmt->bindParam(2, $fecha, PDO::PARAM_STR);
        $stmt->bindParam(3, $idEmpleado, PDO::PARAM_INT);
        $result = $stmt->execute();

        if (!$result) {
            die("Query Failed.");
        }

        $_SESSION['message_entrada'] = 'Asistencia guardada exitosamente';
        $_SESSION['message_type_entrada'] = 'success';
    }
    $_SESSION['horario_saved'] = true;
    header('Location: ../index.php');
}

function existsHorario($fecha, $idEmpleado) {
    global $conn;

    $query = "SELECT COUNT(*) AS count FROM horario WHERE fecha = ? AND idEmpleado = ? ";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $fecha, PDO::PARAM_STR);
    $stmt->bindParam(2, $idEmpleado, PDO::PARAM_INT);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    return $count > 0;
}

function existsEmpleado($idEmpleado) {
    global $conn;

    $query = "SELECT COUNT(*) AS count FROM empleado WHERE idEmpleado = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $idEmpleado, PDO::PARAM_INT);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    return $count > 0;
}
?>


