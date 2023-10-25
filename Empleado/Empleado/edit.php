<?php
include("../db.php");
$idEmpleado = '';
$nombre = '';
$apellido1 = '';
$apellido2 = '';
$email = '';
$fechContrat = '';
$idUsuario = '';
$idPuesto = '';


if (isset($_GET['idEmpleado'])) {
  $idEmpleado = $_GET['idEmpleado'];
  $query = "EXEC paBuscarEmpleadoPorID @idEmpleado=?";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(1, $idEmpleado, PDO::PARAM_INT);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($row) {
    $nombre = $row['nombre'];
    $apellido1 = $row['apellido1'];
    $apellido2 = $row['apellido2'];
    $email = $row['email'];
    $fechContrat = $row['fechContrat'];
    $idUsuario = $row['idUsuario'];
    $idPuesto = $row['idPuesto'];
  }
}

if (isset($_POST['update'])) {
  $idEmpleado = $_POST['idEmpleado'];
  $nombre = $_POST['nombre'];
  $apellido1 = $_POST['apellido1'];
  $apellido2 = $_POST['apellido2'];
  $email = $_POST['email'];
  $fechContrat = $_POST['fechContrat'];
  $idUsuario = $_POST['idUsuario'];
  $idPuesto = $_POST['idPuesto'];


  $query = "EXEC paActualizarEmpleado @idEmpleado=?, @nuevoNombre=?, @nuevoApellido1=?, @nuevoApellido2=?, @nuevoEmail=?, @nuevaFechContrat=?, @idUsuario=?, @idPuesto=?";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(1, $idEmpleado, PDO::PARAM_INT);
  $stmt->bindParam(2, $nombre, PDO::PARAM_STR);
  $stmt->bindParam(3, $apellido1, PDO::PARAM_STR);
  $stmt->bindParam(4, $apellido2, PDO::PARAM_STR);
  $stmt->bindParam(5, $email, PDO::PARAM_STR);
  $stmt->bindParam(6, $fechContrat, PDO::PARAM_STR);
  $stmt->bindParam(7, $idUsuario, PDO::PARAM_INT);
  $stmt->bindParam(8, $idPuesto, PDO::PARAM_INT);
  $stmt->execute();


    $_SESSION['message'] = 'Empleado actualizado exitosamente';
    $_SESSION['message_type'] = 'success';
    $_SESSION['empleado_message'] = true;
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
  <style>
    .custom-label {
      font-weight: bold;
    }

    .custom-submit {
      margin-top: 20px;
    }
  </style>
</head>

<body style="background-image: url(img/fondo-degradado-tonos-verdes_23-2148387744.avif);  background-repeat:  no-repeat;  background-size: cover ;">
  <div class="container p-4">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Editar Empleado</div>
          <div class="card-body">
            <form action="edit.php?idEmpleado=<?php echo $idEmpleado; ?>" method="POST">
              <input type="hidden" name="idEmpleado" value="<?php echo htmlspecialchars($idEmpleado); ?>">
              <div class="form-group row">
                <label for="nombre" class="col-md-4 col-form-label custom-label">Nombre</label>
                <div class="col-md-8">
                  <input name="nombre" type="text" class="form-control" value="<?php echo $nombre; ?>" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="apellido1" class="col-md-4 col-form-label custom-label">Primer apellido</label>
                <div class="col-md-8">
                  <input name="apellido1" type="text" class="form-control" value="<?php echo $apellido1; ?>" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="apellido2" class="col-md-4 col-form-label custom-label">Segundo apellido</label>
                <div class="col-md-8">
                  <input name="apellido2" type="text" class="form-control" value="<?php echo $apellido2; ?>" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label custom-label">Email</label>
                <div class="col-md-8">
                  <input name="email" type="email" class="form-control" value="<?php echo $email; ?>" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="fechContrat" class="col-md-4 col-form-label custom-label">Fecha de Contratación</label>
                <div class="col-md-8">
                  <input name="fechContrat" type="date" class="form-control" value="<?php echo $fechContrat; ?>" required>
                </div>
              </div>
            <div class="form-group row">
              <label class="col-md-4 col-form-label custom-label" for="idUsuario">Usuario del Empleado</label>
              <div class="col-md-8">
                  <select  name="idUsuario" class="form-control" required>
                      <option value="<?php echo $idUsuario; ?>">Seleccione el usuario</option>
                      <?php
                      $query = "SELECT idUsuario, username FROM usuario"; 
                      $stmt = $GLOBALS['conn']->query($query);
                      $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

                      foreach ($usuarios as $usuario) {
                          echo "<option value='" . htmlspecialchars($usuario['idUsuario']) . "'> Nombre de usuario: " . htmlspecialchars($usuario['username']) . " - ID: " . htmlspecialchars($usuario['idUsuario']) . "</option>";
                      }
                      ?>
                  </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-md-4 col-form-label custom-label" for="idPuesto">Puesto del Empleado</label>
              <div class="col-md-8">
                  <select name="idPuesto" class="form-control" required>
                      <option value="">Seleccione el puesto</option>
                      <?php
                      $query = "SELECT idPuesto, puesto FROM puesto"; 
                      $stmt = $GLOBALS['conn']->query($query);
                      $puestos = $stmt->fetchAll(PDO::FETCH_ASSOC);

                      foreach ($puestos as $puesto) {
                          echo "<option value='" . htmlspecialchars($puesto['idPuesto']) . "'> Puesto: " . htmlspecialchars($puesto['puesto']) . " - ID: " . htmlspecialchars($puesto['idPuesto']) . "</option>";
                      }
                      ?>
                  </select>
              </div>
            </div>

              <div class="form-group row custom-submit">
                <div class="col-md-8 offset-md-4">
                  <button class="btn btn-success" type="submit" name="update">Actualizar</button>
                  <a class="btn btn-info" href="../index.php">Volver</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>