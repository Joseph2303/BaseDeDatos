<?php
include("../db.php");

$idHorario = '';
$horaInicio = '';
$horaFin = '';
$fecha = '';
$idEmpleado = '';

if (isset($_POST['update'])) {
    $idEmpleado = $_POST['idEmpleado'];

    date_default_timezone_set('America/Costa_Rica');
    $fecha = date('Y-m-d');


    $query = "SELECT horaInicio, horaFin, fecha, idEmpleado FROM horario WHERE fecha = ? AND idEmpleado = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $fecha, PDO::PARAM_STR);
    $stmt->bindParam(2, $idEmpleado, PDO::PARAM_INT);
    $stmt->execute();
    $count = $stmt->fetchColumn();


    if ($count>0) {
   
        $horaFin = date('H:i:s'); 
        try {
            $query = "EXEC paActualizarHorario  @nuevaHoraFin=? , @nuevaFecha=?,@nuevoIdEmpleado=?";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(1, $horaFin, PDO::PARAM_STR);
            $stmt->bindParam(2, $fecha, PDO::PARAM_STR);           
            $stmt->bindParam(3, $idEmpleado, PDO::PARAM_INT);

            $stmt->execute();
            if($stmt->errorCode() === '00000'){
              $_SESSION['message_salida'] = 'Buen trabajo!! Nos vemos mañana';
              $_SESSION['message_type_salida'] = 'info';
              $_SESSION['horario_edit'] = true;
              header('Location: ../index.php');
            exit();
            }else{

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
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Horario</title>
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <!-- BOOTSTRAP 4 -->
  <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
  <!-- FONT AWESOME -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <style>
    .custom-label {
      font-weight: bold;
    }

    .custom-submit {
      margin-top: 20px;
    }
  </style>
</head>
<body>
  <div class="container p-4">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Editar Horario</div>
          <div class="card-body">
            <form action="editar_horario.php" method="POST">
              <div class="form-group row">
                <label class="col-md-4 col-form-label custom-label">ID del Horario</label>
                <div class="col-md-8">
                  <input name="idHorario" type="text" class="form-control" value="<?php echo $idHorario; ?>" placeholder="ID del Horario" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-4 col-form-label custom-label">Hora de Inicio</label>
                <div class="col-md-8">
                  <input name="horaInicio" type="time" class="form-control" value="<?php echo $horaInicio; ?>" placeholder="Hora de Inicio">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-4 col-form-label custom-label">Hora de Finalización</label>
                <div class="col-md-8">
                  <input name="horaFin" type="time" class="form-control" value="<?php echo $horaFin; ?>" placeholder="Hora de Finalización">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-4 col-form-label custom-label">Fecha</label>
                <div class="col-md-8">
                  <input name="fecha" type="date" class="form-control" value="<?php echo $fecha; ?>" placeholder="Fecha">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-4 col-form-label custom-label">ID del Empleado</label>
                <div class="col-md-8">
                  <input name="idEmpleado" type="text" class="form-control" value="<?php echo $idEmpleado; ?>" placeholder="ID del Empleado" readonly>
                </div>
              </div>
              <button class="btn btn-success custom-submit" name="update">Guardar</button>
              <a class="btn btn-info custom-submit" href="../index.php">Volver</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>


