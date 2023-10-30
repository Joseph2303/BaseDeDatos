<?php
include("../db.php");
session_start();
function login($username, $contrasena) {
  global $conn;

  $query = "EXEC paIniciarSesion @username = :username, @contrasena = :contrasena";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(':username', $username, PDO::PARAM_STR);
  $stmt->bindParam(':contrasena', $contrasena, PDO::PARAM_STR);
  $stmt->execute();
  $result = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($result) {
    return $result;
  } else {
    return null;
  }
}

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $contrasena = $_POST['contrasena'];
  $usuario = login($username, $contrasena);

  if ($usuario) {
    if ($usuario['tipoUsuario'] == 'empleado') {
      $_SESSION['logged_in'] = true;
      $_SESSION['logged_in_admin'] = false;

      $userdataQuery = "SELECT * FROM usuario WHERE username = :username";
      $stmt = $conn->prepare($userdataQuery);
      $stmt->bindParam(':username', $username, PDO::PARAM_STR);
      $stmt->execute();
      $userdata = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($userdata) {
        $_SESSION['userdata'] =  $userdata;
    
        var_dump($_SESSION['userdata']);
        $_SESSION['message'] = '¡Inicio de sesión exitoso! Bienvenido, '.$usuario['tipoUsuario'].': ' . $username. '.';
        header('Location: ../index.php');
      }


    } elseif ($usuario['tipoUsuario'] == 'admin') {
      $_SESSION['logged_in_admin'] = true;
      $_SESSION['logged_in'] = false;

      $_SESSION['message'] = '¡Inicio de sesión exitoso! Bienvenido, '.$usuario['tipoUsuario'].': ' . $username. '.';
      header('Location: ../index.php');
    }
  } else {
    $_SESSION['message_danger'] = 'Inicio de sesión fallido. Credenciales inválidas.';
    header('Location: ../userlogin.php');
  }
}
?>
