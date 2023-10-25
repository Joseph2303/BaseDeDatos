<?php
include("../db.php");

$idSolicitudVacaciones = '';
$fechSolicitud = '';
$fechInicio = '';
$fechFin = '';
$estado = '';
$responsableAut = '';
$descripcion = '';
$idEmpleado = '';

if (isset($_GET['idSolicitudVacaciones'])) {
  $idSolicitudVacaciones = $_GET['idSolicitudVacaciones'];
  $query = "EXEC paBuscarSolicitudVacacionesPorID @idSolicitudVacaciones=?";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(1, $idSolicitudVacaciones, PDO::PARAM_INT);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($row) {
    $fechSolicitud = $row['fechSolicitud'];
    $fechInicio = $row['fechInicio'];
    $fechFin = $row['fechFin'];
    $estado = $row['estado'];
    $responsableAut = $row['responsableAut'];
    $descripcion = $row['descripcion'];
    $idEmpleado = $row['idEmpleado'];
  }
}

if (isset($_POST['update'])) {
  $idSolicitudVacaciones = $_POST['idSolicitudVacaciones'];
  $fechSolicitud = $_POST['fechSolicitud'];
  $fechInicio = $_POST['fechInicio'];
  $fechFin = $_POST['fechFin'];
  $estado = $_POST['estado'];
  $responsableAut = $_POST['responsableAut'];
  $descripcion = $_POST['descripcion'];
  $idEmpleado = $_POST['idEmpleado'];

  $query = "EXEC paActualizarSolicitudVacaciones @idSolicitudVacaciones=?, @nuevaFechSolicitud=?, @nuevaFechInicio=?, @nuevaFechFin=?, @nuevoEstado=?, @nuevoResponsableAut=?, @nuevaDescripcion=?, @nuevoIdEmpleado=?";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(1, $idSolicitudVacaciones, PDO::PARAM_INT);
  $stmt->bindParam(2, $fechSolicitud, PDO::PARAM_STR);
  $stmt->bindParam(3, $fechInicio, PDO::PARAM_STR);
  $stmt->bindParam(4, $fechFin, PDO::PARAM_STR);
  $stmt->bindParam(5, $estado, PDO::PARAM_STR);
  $stmt->bindParam(6, $responsableAut, PDO::PARAM_STR);
  $stmt->bindParam(7, $descripcion, PDO::PARAM_STR);
  $stmt->bindParam(8, $idEmpleado, PDO::PARAM_INT);
  $stmt->execute();

  $_SESSION['message'] = 'Solicitud de Vacaciones actualizada exitosamente';
  $_SESSION['message_type'] = 'success';
  $_SESSION['solicitud_message'] = true;
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
            <form action="edit.php?idSolicitudVacaciones=<?php echo $_GET['idSolicitudVacaciones']; ?>" method="POST">
                <div class="form-group row">
                <label class="col-md-4 col-form-label custom-label" >Id de la solicitud</label>
                <div class="col-md-8">
                  <input name="idSolicitudVacaciones" type="text" class="form-control" value="<?php echo $idSolicitudVacaciones; ?>" placeholder="User name" readonly>
                </div>
              </div>
                <div class="form-group row">
                <label  class="col-md-4 col-form-label custom-label">Fecha de la solicitud</label>
                <div class="col-md-8">
                  <input name="fechSolicitud" type="date" class="form-control" value="<?php echo $fechSolicitud; ?>" placeholder="Update contrasena" readonly> 
                </div>

              </div>
                <div class="form-group row">

                <label  class="col-md-4 col-form-label custom-label">Fecha de inicio de las vaciones</label>
                <div class="col-md-8">

                  <input name="fechInicio" type="date" class="form-control" value="<?php echo $fechInicio; ?>" placeholder="Update tipoUsuario" >
                </div> 
              </div>

                <div class="form-group row">
                <label  class="col-md-4 col-form-label custom-label">Fecha de finalización</label>
                <div class="col-md-8">

                  <input name="fechFin" type="date" class="form-control" value="<?php echo $fechFin; ?>" placeholder="Update tipoUsuario" >
                </div> 
              </div>
                <div class="form-group row">
                <label  class="col-md-4 col-form-label custom-label">Estado de la solicitud</label>

                <div class="col-md-8">

                  <input name="estado" type="text" class="form-control" value="<?php echo $estado; ?>" placeholder="estado " readonly>
                </div>
              </div>
                <div class="form-group row">
                  <label class="col-md-4 col-form-label custom-label">Nombre del responsable</label>
                  <div class="col-md-8">

                  <input name="responsableAut" type="text" class="form-control" value="<?php echo $responsableAut; ?>" placeholder="nombre" readonly>
                  </div> 
              </div>
                <div class="form-group row">
                <label class="col-md-4 col-form-label custom-label">Descripcion</label>

                <div class="col-md-8">

                  <input name="descripcion" type="text" class="form-control" value="<?php echo $descripcion; ?>" placeholder=" descripcion" readonly>
                </div>  
              </div>
                <div class="form-group row">
                <label class="col-md-4 col-form-label custom-label">Id del empleado</label>
                <div class="col-md-8">

                  <input name="idEmpleado" type="text" class="form-control" value="<?php echo $idEmpleado; ?>" placeholder="ID" readonly>
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
