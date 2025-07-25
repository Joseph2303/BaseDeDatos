<?php
include("../db.php");
function login($username, $contrasena) {
  global $conn;

  $UsuarioIntento = $username;  

  $consult = "EXEC paAgregarAuditoriaInicioSesion  @UsuarioIntento = :UsuarioIntento";
  $stmt2 = $conn->prepare($consult);
  $stmt2->bindParam(':UsuarioIntento', $UsuarioIntento, PDO::PARAM_STR);
  $stmt2->execute();



  $query = "EXEC paIniciarSesion @username = :username, @contrasena = :contrasena ";
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
      $_SESSION['authentication'] = true;
      $_SESSION['cont'] = false;


      $userdataQuery = "SELECT * FROM usuario WHERE username = :username";
      $stmt = $conn->prepare($userdataQuery);
      $stmt->bindParam(':username', $username, PDO::PARAM_STR);
      $stmt->execute();
      $userdata = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($userdata) {
        $_SESSION['userdata'] =  $userdata;
        
        $idUsuario = $userdata['idUsuario'];

        $userdataQuery = "SELECT * FROM empleado WHERE idUsuario = :idUsuario";
        $stmt = $conn->prepare($userdataQuery);
        $stmt->bindParam(':idUsuario', $idUsuario, PDO::PARAM_STR);
        $stmt->execute();
        $empleado = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['empleadoData'] = $empleado;
        
        var_dump($_SESSION['empleadoData']);
        var_dump($_SESSION['userdata']);
        $_SESSION['message'] = '¡Inicio de sesión exitoso! Bienvenido, '.$usuario['tipoUsuario'].': ' . $username. '.';
        header('Location: ../includ/proted.php');
      }


    } elseif ($usuario['tipoUsuario'] == 'admin') {
      $_SESSION['logged_in_admin'] = true;
      $_SESSION['logged_in'] = false;
      $_SESSION['authentication'] = true;
      $_SESSION['cont'] = true;

      $_SESSION['message'] = '¡Inicio de sesión exitoso! Bienvenido, '.$usuario['tipoUsuario'].': ' . $username. '.';
      header('Location: ../includ/proted.php');
    }
  } else {
    $_SESSION['message_danger'] = 'Inicio de sesión fallido. Credenciales inválidas.';
    header('Location: ../userlogin.php');
  }
}
?>
