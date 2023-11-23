<?php
include("../db.php");

$idPuesto = '';
$puesto = '';

if (isset($_GET['idPuesto'])) {
    $idPuesto = $_GET['idPuesto'];
    $query = "EXEC paBuscarPuesto @idPuesto=?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $idPuesto, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $idPuesto = $row['idPuesto'];
        $puesto = $row['puesto'];
    }
}

if (isset($_POST['update'])) {
    $idPuesto = $_POST['idPuesto'];
    $puesto = $_POST['puesto'];

    $queryUpdate = "EXEC paActualizarPuestoYEmpleado @idPuesto=?, @puesto=?";
    $stmtUpdate = $conn->prepare($queryUpdate);
    $stmtUpdate->bindParam(1, $idPuesto, PDO::PARAM_INT);
    $stmtUpdate->bindParam(2, $puesto, PDO::PARAM_STR);
    $stmtUpdate->execute();

    $_SESSION['message'] = 'Puesto actualizado exitosamente';
    $_SESSION['message_type'] = 'success';
    $_SESSION['puesto_message'] = true;
    header('Location: ../index.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Puesto</title>
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
              <input name="idPuesto" type="text" class="form-control" value="<?php echo $idPuesto; ?>" placeholder="ID del Puesto" readonly>
            </div>
            <div class="form-group">
              <label for="puesto">Puesto</label>
              <input name="puesto" id="puesto" type="text" class="form-control" value="<?php echo $puesto; ?>" placeholder="Actualizar puesto" require>
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