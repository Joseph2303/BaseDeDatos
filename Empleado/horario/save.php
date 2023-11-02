<?php
include('../db.php');
if (isset($_POST['save'])) {
    if (isset($_SESSION['userdata']) && isset($_SESSION['userdata']['idUsuario'])) {
        $idUsuario = $_SESSION['userdata']['idUsuario'];

        $userdataQuery = "SELECT * FROM empleado WHERE idUsuario = :idUsuario";
        $stmt = $conn->prepare($userdataQuery);
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_STR);
        $stmt->execute();
        $empleado = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['empleadoData'] = $empleado;
        $idEmpleado = $empleado['idEmpleado'];
   
    date_default_timezone_set('America/Costa_Rica');

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

    } else {
        
        $_SESSION['message_entrada'] = "No se ha encontrado el nombre de usuario en la sesión.";
        $_SESSION['message_type_entrada'] = 'danger';
        exit();
    }
    

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


