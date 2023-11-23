<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $contrasena = $_POST['contrasena'];
  $tipoUsuario = isset($_POST['tipoUsuario']) ? $_POST['tipoUsuario'] : 'empleado'; // Valor predeterminado: "Empleado"

  try {
  // Verificar si el nombre de usuario ya existe en la base de datos
  $existingUserQuery = "SELECT COUNT(*) AS count FROM usuario WHERE username = ?";
  $stmt = $conn->prepare($existingUserQuery);
  $stmt->bindParam(1, $username, PDO::PARAM_STR);
  $stmt->execute();
  $count = $stmt->fetchColumn();
  $stmt->closeCursor();

  if ($count > 0) {
    // El nombre de usuario ya existe
    $_SESSION['message_danger'] = 'Error, el nombre de usuario ya está en uso.';
    header('Location: userLogin.php');
    exit();
  }

  if (!empty($username)) {
    $sql = "EXEC paInsertarUsuario @username=?, @contrasena=?, @tipoUsuario=?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $username, PDO::PARAM_STR);
    $stmt->bindParam(2, $contrasena, PDO::PARAM_STR);
    $stmt->bindParam(3, $tipoUsuario, PDO::PARAM_STR);
    $result = $stmt->execute();


    if ($result) {
      $_SESSION['message_info'] = 'Usuario creado exitosamente.';
      $_SESSION['message_type'] = 'success';
      header('Location: userLogin.php'); // Redirige a userLogin.php
      exit; // Finaliza la ejecución del script después de la redirección
    } else {
      $_SESSION['message_danger'] = 'Error al crear el usuario.';
      header('Location: userLogin.php');
      $message_type = 'error';
    }    
  }
  } catch (PDOException $exp) {
    $_SESSION['message_danger'] = 'Error al crear el usuario: ' . $exp->getMessage();
    header('Location: userLogin.php');
  }
}
?>


<head>
  <meta charset="UTF-8">
  <title>Crear cuenta</title>
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <!-- BOOTSTRAP 4 -->
  <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
  <!-- FONT AWESOME -->
  <link rel="icon" type="image/x-icon" href="img/letra-h.png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<style>
.crear-container {
   margin-left: 22%;
    margin-right: 22%;
    margin-top: 1%;
    margin-top: 100px;
  }
</style>
</head>
<body style="background-image: url(img/copy_of_078a0158-e1619707652706-1026x536-c-45x79.jpg);  background-repeat:  no-repeat;  background-size: cover ;">
 
<div  class="crear-container" >
<div class="p-5 rounded-5 text-secondary shadow" 
style="background-color: rgba(32, 124, 196, 0.7);">
    <h2 style="color: white;">Crear Usuario</h2>
    <?php if (isset($message)) { ?>
      <div class="<?php echo $message_type; ?>">
        <?php echo $message; ?>
      </div>
    <?php } ?>
    <form action="" method="POST">
  <div class="form-group">
    <label style="color: white;" for="username">Nombre de Usuario:</label>
    <input name="username" type="text" class="form-control" placeholder="Nombre de usuario" required>
  </div>
  <div class="form-group">
    <label style="color: white;" for="password">Contraseña:</label>
    <input type="password" class="form-control" name="contrasena" required placeholder="Contraseña">
  </div>
  <div class="form-group">
    <button href="userLogin.php" type="submit" name="save" class="btn btn-primary">Crear</button>
  </div>
</form>
  </div>
    </div>
</body>
</html>