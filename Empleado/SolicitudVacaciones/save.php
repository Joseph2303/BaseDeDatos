<?php
include('../db.php');

if (isset($_POST['save'])) {
    if (isset($_SESSION['empleadoData']) && isset($_SESSION['empleadoData']['idEmpleado'])) {

        $fechSolicitud = $_POST['fechSolicitud'];
        $fechInicio = $_POST['fechInicio'];
        $fechFin = $_POST['fechFin'];
        $estado = $_POST['estado'];
        $responsableAut = $_POST['responsableAut'];
        $descripcion = $_POST['descripcion'];
        $idEmpleado = $_SESSION['empleadoData']['idEmpleado'];
        $fechSolicitud = date('Y-m-d');

        $existingSolicitudQuery = "EXEC paVerificarSolicitudVaciones @fechInicio = ?, @fechFin = ?, @idEmpleado = ?";
        $stmt = $conn->prepare($existingSolicitudQuery);
        $stmt->bindParam(1, $fechInicio, PDO::PARAM_STR);
        $stmt->bindParam(2, $fechFin, PDO::PARAM_STR);
        $stmt->bindParam(3, $idEmpleado, PDO::PARAM_INT);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        $stmt->closeCursor();

        if ($count > 0) {
            // Ya existe una solicitud para el mismo periodo y empleado
            $_SESSION['message_danger'] = 'Error, ya existe una solicitud para este periodo y empleado.';
            $_SESSION['solicitud_message'] = true;
            header('Location: ../index.php');
            exit();
        } else {
            $sql = "EXEC paInsertarSolicitudVacaciones @fechSolicitud = :fechSolicitud, @fechInicio = :fechInicio, @fechFin = :fechFin, @estado = :estado, @responsableAut = :responsableAut, @descripcion = :descripcion, @idEmpleado = :idEmpleado";
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':fechSolicitud', $fechSolicitud, PDO::PARAM_STR);
            $stmt->bindParam(':fechInicio', $fechInicio, PDO::PARAM_STR);
            $stmt->bindParam(':fechFin', $fechFin, PDO::PARAM_STR);
            $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);
            $stmt->bindParam(':responsableAut', $responsableAut, PDO::PARAM_STR);
            $stmt->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
            $stmt->bindParam(':idEmpleado', $idEmpleado, PDO::PARAM_INT);
            $stmt->execute();

            if ($stmt->errorCode() === '00000') {
                $_SESSION['message'] = 'Solicitud de vacaciones registrada con éxito';
                $_SESSION['message_type'] = 'success';
                $_SESSION['solicitud_message'] = true;
                header('Location: ../index.php');
                exit();
            } else {
                $_SESSION['message'] = 'Error al registrar la solicitud de vacaciones.';
                $_SESSION['message_type'] = 'danger';
                $_SESSION['solicitud_message'] = true;
                header('Location: ../index.php');
                exit();
            }
        }
    }
}
