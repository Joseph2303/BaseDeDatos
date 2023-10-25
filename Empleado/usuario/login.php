<?php
include("../db.php");
/*
<?php
    session_start();

    if(isset($_GET['cerrar_sesion'])){
        session_unset(); 

        // destroy the session 
        session_destroy(); 
    }
    
    if(isset($_SESSION['tipoUsuario'])){
        switch($_SESSION['tipoUsuario']){
            case 1:
                header('location: ../index.php');
            break;

            case 2:
            header('location: ../index.php');
            break;

            default:
        }
    }

    if(isset($_POST['username']) && isset($_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $db = new Database();
        $query = $db->connect()->prepare('SELECT * FROM usuario WHERE username = :username AND password = :password');
        $query->execute(['username' => $username, 'password' => $password]);

        $row = $query->fetch(PDO::FETCH_NUM);
        
        if($row == true){
            $tipoUsuario = $row[3];
            
            $_SESSION['tipoUsuario'] = $tipoUsuario;
            switch($tipoUsuario){
                case 1:
                    header('location: ../index.php');
                break;

                case 2:
                header('location: ../index.php');
                break;

                default:
            }
        }else{
            // no existe el usuario
            echo "Nombre de usuario o contraseña incorrecto";
        }
        

    }
*/

function login($username, $contrasena) {
  global $conn;

  $query = "EXEC paIniciarSesion @username = ?, @contrasena = ?";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(1, $username, PDO::PARAM_STR);
  $stmt->bindParam(2, $contrasena, PDO::PARAM_STR);
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


      $existingSolicitudQuery = "SELECT * FROM usuario WHERE username = $username";
      $stmt = $conn->prepare($existingSolicitudQuery);
      $stmt->bindParam(1, $username, PDO::PARAM_STR);
      $stmt->execute();

      $userdata = $stmt->fetch(PDO::FETCH_ASSOC);


      $_SESSION['message'] = '¡Inicio de sesión exitoso! Bienvenido,'.$usuario['tipoUsuario'].': ' . $username. '.';
      header('Location: ../index.php');
      exit();
    } elseif ($usuario['tipoUsuario'] == 'admin') {
      $_SESSION['logged_in_admin'] = true;
      $_SESSION['logged_in'] = false;

      $_SESSION['message'] = '¡Inicio de sesión exitoso! Bienvenido, '.$usuario['tipoUsuario'].': ' . $username. '.';
      header('Location: ../index.php');
      exit();
    }
  } else {
    $_SESSION['message_danger'] = 'Inicio de sesión fallido. Credenciales inválidas.'.$usuario['tipoUsuario'];

    header('Location: ../userlogin.php');
    exit();
  }
}
?>
<script>
  // Obtén los datos del usuario del servidor y almacénalos en el localStorage

    var userData = <?php echo json_encode($userdata); ?>; 
    if(userData){
      localStorage.setItem('userData', JSON.stringify(userData));
    }
</script>



