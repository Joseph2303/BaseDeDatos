<?php
include("../db.php");

$idUsuario =  '';
$username = '';
$contrasena = '';
$tipoUsuario = '';

if (isset($_GET['idUsuario'])) {

    $idUsuario = $_GET['idUsuario'];
    $query = "EXEC paBuscarUsuarioPorID @idUsuario=?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $idUsuario, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
    if ($row) {
        $idUsuario = $row['idUsuario'];
        $username = $row['username'];
        $contrasena = $row['contrasena'];
        $tipoUsuario = $row['tipoUsuario'];
      }
}


if (isset($_POST['update'])) {
    $idUsuario = $_POST['idUsuario'];
    $username = $_POST['username'];
    $contrasena = $_POST['contrasena'];
    $tipoUsuario = $_POST['tipoUsuario'];
  
    $query = "EXEC paActualizarUsuario @idUsuario=?, @nuevoUsername=?, @nuevaContrasena=?, @nuevoTipoUsuario=?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $idUsuario, PDO::PARAM_INT);
    $stmt->bindParam(2, $username, PDO::PARAM_STR);
    $stmt->bindParam(3, $contrasena, PDO::PARAM_STR);
    $stmt->bindParam(4, $tipoUsuario, PDO::PARAM_STR);
    $stmt->execute();
  
    $_SESSION['message'] = 'Usuario actualizado exitosamente';
    $_SESSION['message_type'] = 'success';
    $_SESSION['usuario_message'] = true;
    header('Location: ../index.php');
    exit();
}


?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Usuario</title>
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <!-- BOOTSTRAP 4 -->
  <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
  <!-- FONT AWESOME -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>
<body>
  <div class="container p-4">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Editar Usuario</div>
          <div class="card-body">
            <form action="edit.php?idUsuario=<?php echo $_GET['idUsuario']; ?>" method="POST">
              <div class="form-group row">
                <label class="col-md-4 col-form-label custom-label">ID de Usuario</label>
                <div class="col-md-8">
                  <input name="idUsuario" type="text" class="form-control" value="<?php echo $idUsuario; ?>" placeholder="ID de Usuario" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-4 col-form-label custom-label">Nombre de Usuario</label>
                <div class="col-md-8">
                  <input name="username" type="text" class="form-control" value="<?php echo $username; ?>" placeholder="Nombre de Usuario" >
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-4 col-form-label custom-label">Contraseña</label>
                <div class="col-md-8">
                  <input name="contrasena" type="password" class="form-control" value="<?php echo $contrasena; ?>" placeholder="Contraseña">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-4 col-form-label custom-label">Tipo de Usuario</label>
                <div class="col-md-8">
                  <input name="tipoUsuario" type="text" class="form-control" value="<?php echo $tipoUsuario; ?>" placeholder="Tipo de Usuario">
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
</body>
</html>


