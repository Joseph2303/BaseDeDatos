<?php
include("../db.php");

$idJustificacionAusencia = '';
$fechaSolicitud = '';
$fechaAusencia = '';
$justificacion = '';
$estado = '';
$NombreEncargado = '';
$descripcion = '';
$idEmpleado = '';

if (isset($_GET['idJustificacionAusencia'])) {
  $idJustificacionAusencia = $_GET['idJustificacionAusencia'];
  $query = "EXEC paBuscarJustificacionAusenciaPorId @idJustificacionAusencia=?";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(1, $idJustificacionAusencia, PDO::PARAM_INT);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($row) {
    $fechaSolicitud = $row['fechaSolicitud'];
    $fechaAusencia = $row['fechaAusencia'];
    $justificacion = $row['justificacion'];
    $estado = $row['estado'];
    $NombreEncargado = $row['NombreEncargado'];
    $descripcion = $row['descripcion'];
    $idEmpleado = $row['idEmpleado'];
  }
}

if (isset($_POST['update'])) {
    $idJustificacionAusencia = $_POST['idJustificacionAusencia'];
    $fechaSolicitud = $_POST['fechaSolicitud'];
    $fechaAusencia = $_POST['fechaAusencia'];
    $justificacion = $_POST['justificacion'];
    $estado = $_POST['estado'];
    $NombreEncargado = $_POST['NombreEncargado'];
    $descripcion = $_POST['descripcion'];
    $idEmpleado = $_POST['idEmpleado'];


    $query = "EXEC paActualizarJustificacionAusencia @idJustificacionAusencia=?, @nuevaFechaSolicitud=?, @nuevaFechaAusencia=?, @nuevaJustificacion=?, @nuevoEstado=?, @nuevoNombreEncargado=?, @nuevaDescripcion=?, @nuevoIdEmpleado=?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $idJustificacionAusencia, PDO::PARAM_INT);
    $stmt->bindParam(2, $fechaSolicitud, PDO::PARAM_STR);
    $stmt->bindParam(3, $fechaAusencia, PDO::PARAM_STR);
    $stmt->bindParam(4, $justificacion, PDO::PARAM_STR);
    $stmt->bindParam(5, $estado, PDO::PARAM_STR);
    $stmt->bindParam(6, $NombreEncargado, PDO::PARAM_STR);
    $stmt->bindParam(7, $descripcion, PDO::PARAM_STR);
    $stmt->bindParam(8, $idEmpleado, PDO::PARAM_INT);
    $stmt->execute();

  $_SESSION['message'] = 'Justificación de Ausencia actualizada exitosamente';
  $_SESSION['message_type'] = 'success';
  $_SESSION['justificacion_message'] = true;
  header('Location: ../index.php');
  exit();
}
?>
<head>
  <meta charset="UTF-8">
  <title>Empleado</title>
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <!-- BOOTSTRAP 4 -->
  <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
  <!-- FONT AWESOME -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>
<div class="container p-4">
<div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Editar solicitud</div>
          <div class="card-body">
            <form action="edit.php?idJustificacionAusencia=<?php echo $_GET['idJustificacionAusencia']; ?>" method="POST">
                <div class="form-group row">
                    <label class="col-md-4 col-form-label custom-label">Id de la justificación</label>
                    <div class="col-md-8">
                    <input name="idJustificacionAusencia" type="text" class="form-control" value="<?php echo $idJustificacionAusencia; ?>" placeholder="ID" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label custom-label">Fecha de la solicitud</label>
                    <div class="col-md-8">
                    <input name="fechaSolicitud" type="date" class="form-control" value="<?php echo $fechaSolicitud; ?>" placeholder="Fecha de Solicitud" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label custom-label">Fecha de ausencia</label>
                    <div class="col-md-8">
                    <input name="fechaAusencia" type="date" class="form-control" value="<?php echo $fechaAusencia; ?>" placeholder="Fecha de Ausencia" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label custom-label">Justificación</label>
                    <div class="col-md-8">
                        <input name="justificacion" type="text" class="form-control" value="<?php echo $justificacion; ?>" placeholder="Justificación" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label custom-label">Estado de la justificación</label>
                    <div class="col-md-8">
                    <input name="estado" type="text" class="form-control" value="<?php echo $estado; ?>" placeholder="Estado">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label custom-label">Nombre del encargado</label>
                    <div class="col-md-8">
                    <input name="NombreEncargado" type="text" class="form-control" value="<?php echo $NombreEncargado; ?>" placeholder="Nombre del Encargado">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label custom-label">Descripción</label>
                    <div class="col-md-8">
                    <input name="descripcion" type="text" class="form-control" value="<?php echo $descripcion; ?>" placeholder="Descripción">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-4 col-form-label custom-label">Id del empleado</label>
                    <div class="col-md-8">
                    <input name="idEmpleado" type="text" class="form-control" value="<?php echo $idEmpleado; ?>" placeholder="ID del Empleado" readonly>
                    </div>
                </div>
                <button class="btn btn-success" name="update">Guardar</button>
                <a class="btn btn-info" href="../index.php">Volver</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>