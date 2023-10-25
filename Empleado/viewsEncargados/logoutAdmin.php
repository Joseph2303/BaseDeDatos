<?php
session_start();

  $_SESSION['message_close'] = 'Sesión está cerrada';
  $_SESSION['val_close']=true;
  unset($_SESSION['logged_in']);
  $_SESSION['logged_in_admin'] = false;

header("Location: ../index.php");
exit();
?>
