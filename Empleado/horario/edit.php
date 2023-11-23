<?php
include("../db.php");

$idHorario = '';
$horaInicio = '';
$horaFin = '';
$fecha = '';
$idEmpleado = '';

if (isset($_POST['update'])) {

    if (isset($_SESSION['empleadoData']) && isset($_SESSION['empleadoData']['idEmpleado'])) {
        $idEmpleado = $_SESSION['empleadoData']['idEmpleado'];

        date_default_timezone_set('America/Costa_Rica');
        $fecha = date('Y-m-d');

        // Verificar si ya existe una hora de finalización para la fecha actual y el empleado
        $queryExistencia = "SELECT COUNT(*) FROM horario WHERE fecha = ? AND idEmpleado = ? AND horaFin IS NOT NULL";
        $stmtExistencia = $conn->prepare($queryExistencia);
        $stmtExistencia->bindParam(1, $fecha, PDO::PARAM_STR);
        $stmtExistencia->bindParam(2, $idEmpleado, PDO::PARAM_INT);
        $stmtExistencia->execute();
        $existenciaCount = $stmtExistencia->fetchColumn();

        if ($existenciaCount > 0) {
            $_SESSION['message_salida'] = 'Ya existe una hora de finalización para hoy.';
            $_SESSION['message_type_salida'] = 'danger';
            $_SESSION['horario_edit'] = true;
            header('Location: ../index.php');
            exit();
        }

        $query = "SELECT horaInicio, horaFin, fecha, idEmpleado FROM horario WHERE fecha = ? AND idEmpleado = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $fecha, PDO::PARAM_STR);
        $stmt->bindParam(2, $idEmpleado, PDO::PARAM_INT);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            $horaFin = date('H:i:s');
            try {
                $query = "EXEC paActualizarHorario  @nuevaHoraFin=? , @nuevaFecha=?,@nuevoIdEmpleado=?";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(1, $horaFin, PDO::PARAM_STR);
                $stmt->bindParam(2, $fecha, PDO::PARAM_STR);
                $stmt->bindParam(3, $idEmpleado, PDO::PARAM_INT);

                $stmt->execute();
                if ($stmt->errorCode() === '00000') {
                    $_SESSION['message_salida'] = 'Buen trabajo!! Nos vemos mañana';
                    $_SESSION['message_type_salida'] = 'info';
                    $_SESSION['horario_edit'] = true;
                    header('Location: ../index.php');
                    exit();
                } else {
                }
            } catch (PDOException $exp) {
                $_SESSION['message_salida'] = 'Error al actualizar la hora de salida: ' . $exp->getMessage();
                $_SESSION['message_type_salida'] = 'danger';
                $_SESSION['horario_edit'] = true;
                header('Location: ../index.php');
                exit();
            }
        } else {
            $_SESSION['message_salida'] = 'Debes primeramente marcar tu entrada ';
            $_SESSION['message_type_salida'] = 'danger';
            $_SESSION['horario_edit'] = true;
            header('Location: ../index.php');
            exit();
        }
    } else {
        $_SESSION['message_salida'] = 'ERROR ';
        $_SESSION['message_type_salida'] = 'danger';
        $_SESSION['horario_edit'] = true;
        header('Location: ../index.php');
    }
}
?>
