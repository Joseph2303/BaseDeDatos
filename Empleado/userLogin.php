<?php include("db.php"); ?>
<head>
  <title>HCR Login</title>
  <link rel="icon" type="image/x-icon" href="img/letra-h.png">
  <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
 </head>
<style>
    .login-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    margin-top: 100px;
  }

  input[type="text"],
  input[type="password"],
  button {
    background-color: transparent;
    border: none;
    border-bottom: 1px solid #fff; /* Cambiado de #000 a #fff */
    outline: none;
    padding: 5px;
    margin-bottom: 10px;
    color: #fff; /* Cambiado de #000 a #fff */
    transition: border-color 0.3s;
  }

  input:hover {
    border-color: #ff0000;
  }

  button:hover {
    border-color: #ff0000;
  }

</style>
<body style="background-image: url(img/copy_of_078a0158-e1619707652706-1026x536-c-45x79.jpg); 
background-repeat: no-repeat; background-size: cover; font-family: 'century Gothic', sans-serif ;">

<div class="d-flex justify-content-center align-items-center vh-100">

<div class="p-5 rounded-5 text-secondary shadow" 
style="background-color: rgba(32, 124, 196, 0.8);">

<img src="img/siglas_coriport.png" style=" width: 230px; height: 110px;"> 

<div class="login-container" style="font-family: 'century Gothic', sans-serif ;">

    <h1 style="color: #fff;">Iniciar sesión</h1>

    <form method="POST" action="usuario/login.php">

    <h4 class="bi bi-person" style="color: #fff;">Usuario</h4>

      <input style="color: #fff; " type="text" name="username" required >

    <h4 class="bi bi-lock" style="color: #fff;">Contraseña</h4>
      <input style="color: #fff;" type="password" name="contrasena" required >
      <br>
      <button  type="submit" name="login">Iniciar sesión</button>
    </form>
    <form >
    <button  formaction="CrearUser.php" >Crear Cuenta</button>
    </form>
  </div>
</div>
</div>
  <?php
  if (isset($_SESSION['message_danger'])){
    echo '<div id="success-message" class="alert alert-danger">' . $_SESSION['message_danger'] . '</div>';
    unset($_SESSION['message_danger']);
  }
  ?>

  <script>
    setTimeout(function() {
      document.getElementById('success-message').style.display = 'none';
    }, 9500);
  </script>