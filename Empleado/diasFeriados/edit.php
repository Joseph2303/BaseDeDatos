<?php
include("../db.php");

$idDiasFeriados = '';
$fecha = '';
$descripcion = '';
$tipoFeriado = '';

if (isset($_GET['id'])) {
  $idDiasFeriados = $_GET['id'];
  $query = "EXEC paBuscarDiaFeriadoPorID @idDiasFeriados=?";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(1, $idDiasFeriados, PDO::PARAM_INT);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($row) {
    $fecha = $row['fecha'];
    $descripcion = $row['descripcion'];
    $tipoFeriado = $row['tipoFeriado'];
  }
}

if (isset($_POST['update'])) {
  $idDiasFeriados = $_POST['idDiasFeriados'];
  $fecha = $_POST['fecha'];
  $descripcion = $_POST['descripcion'];
  $tipoFeriado = $_POST['tipoFeriado'];

  $query = "EXEC paActualizarDiasFeriado @idDiasFeriados=?, @nuevaFecha=?, @nuevaDescripcion=?, @nuevoTipoFeriado=?";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(1, $idDiasFeriados, PDO::PARAM_INT);
  $stmt->bindParam(2, $fecha, PDO::PARAM_STR);
  $stmt->bindParam(3, $descripcion, PDO::PARAM_STR);
  $stmt->bindParam(4, $tipoFeriado, PDO::PARAM_STR);
  $stmt->execute();

  $_SESSION['message'] = 'Día Feriado actualizado exitosamente';
  $_SESSION['message_type'] = 'success';
  $_SESSION['feriado_message'] = true;
  header('Location: ../index.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Día Feriado</title>
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

  <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
 
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
    <div class="row">
      <div class="col-md-4 mx-auto">
        <div class="card card-body">
          <form action="edit.php" method="POST">
            <div class="form-group">
              <input name="idDiasFeriados" type="text" class="form-control" value="<?php echo $idDiasFeriados; ?>" placeholder="ID del día feriado" readonly>
            </div>
            <div class="form-group">
              <label for="fecha">Fecha</label>
              <input name="fecha" id="fecha" type="date" class="form-control" value="<?php echo $fecha; ?>" placeholder="Actualizar fecha">
            </div>
            <div class="form-group">
              <label for="descripcion">Descripción</label>
              <input name="descripcion" id="descripcion" type="text" class="form-control" value="<?php echo $descripcion; ?>" placeholder="Actualizar descripción">
            </div>
            <div class="form-group">
              <label>Tipo de día feriado</label>
              <select name="tipoFeriado" class="form-control" required>
                <option value="obligatorio" <?php echo ($tipoFeriado == 'obligatorio') ? 'selected' : ''; ?>>Pago Obligatorio</option>
                <option value="no obligatorio" <?php echo ($tipoFeriado == 'no obligatorio') ? 'selected' : ''; ?>>Pago No Obligatorio</option>
              </select>
            </div>
            <button class="btn btn-success" name="update">Actualizar</button>
            <a class="btn btn-info" href="../index.php">Volver</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>

