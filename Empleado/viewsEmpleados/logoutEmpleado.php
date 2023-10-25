<?php
session_start();
  $_SESSION['message_close'] = 'Sesión esta cerrada';
  $_SESSION['val_close']=true;
  unset($_SESSION['logged_in']);
  $_SESSION['logged_in']=false;
  header("Location: ../index.php");
  exit();

?>
