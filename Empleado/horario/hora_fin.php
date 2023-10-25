<?php
include("../db.php");

function actualizarHoraFinal($idEmpleado, $fechaActual, $horaFin, $conn)
{
    $query = "SELECT * FROM horario WHERE fecha = ? AND idEmpleado = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $fechaActual, PDO::PARAM_STR);
    $stmt->bindParam(2, $idEmpleado, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) > 0) {
        try {
            $query = "EXEC paInsertarHorario @idEmpleado=?, @fecha=?, @horaFin=?";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(1, $idEmpleado, PDO::PARAM_INT);
            $stmt->bindParam(2, $fechaActual, PDO::PARAM_STR);
            $stmt->bindParam(3, $horaFin, PDO::PARAM_STR);
            $result = $stmt->execute();

            if ($result) {
                header('Location: ../viewsEmpleados/horafin.php');
                exit();
            } else {
                return false;
            }
        } catch (PDOException $exp) {
          
            return false;
        }
    } else {
        return false;
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Actualizar Hora Final</title>
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
          <div class="card-header">Actualizar Hora Final</div>
          <div class="card-body">
            <form action="actualizar_hora_final.php" method="POST">
              <div class="form-group row">
                <label class="col-md-4 col-form-label custom-label">ID del Empleado</label>
                <div class="col-md-8">
                  <input name="idEmpleado" type="text" class="form-control" value="<?php echo $idEmpleado; ?>" placeholder="ID del Empleado" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-4 col-form-label custom-label">Fecha Actual</label>
                <div class="col-md-8">
                  <input name="fechaActual" type="date" class="form-control" value="<?php echo $fechaActual; ?>" placeholder="Fecha Actual">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-4 col-form-label custom-label">Hora de Finalización</label>
                <div class="col-md-8">
                  <input name="horaFin" type="time" class="form-control" value="<?php echo $horaFin; ?>" placeholder="Hora de Finalización">
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
