<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include("../db.php");
if (isset($_SESSION['logged_in_admin']) && $_SESSION['logged_in_admin'] === true) {
  $_SESSION['cont'] = true;
}
include('../includ/proted.php');

if (isset($_SESSION['empleadoData']) && isset($_SESSION['empleadoData']['idEmpleado'])) {

  function consultarJustificacion()
  {
    $idEmpleado = $_SESSION['empleadoData']['idEmpleado'];
    $query = "SELECT * FROM justificacionAusencia where idEmpleado = $idEmpleado ORDER BY idEmpleado DESC";

    try {
      $stmt = $GLOBALS['conn']->query($query);
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $rows;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return [];
    }
  }

  $justificacionAusencia = consultarJustificacion();
}
?>


<!DOCTYPE html>
<html>

<head>
  <style>
    .container {
      margin-left: 22%;
      margin-right: 22%;
      margin-top: 1%;
    }

    .alert {
      margin-bottom: 10px;
    }

    form {
      margin-bottom: 20px;
    }

    table {
      border-collapse: collapse;
      width: 100%;
      max-width: 650px;
      /* Ajusta este valor según tus necesidades */
    }

    th,
    td {
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #93D78C;
      color: #fff;
    }

    button {
      padding: 8px 12px;
      background-color: #333;
      color: #fff;
      border: none;
      cursor: pointer;
    }

    button:hover {
      background-color: #555;
    }

    .btn-secondary {
      background-color: #555;
    }

    .btn-secondary:hover {
      background-color: #777;
    }

    .fa-marker {
      margin-right: 5px;
    }

    .search-form {
      float: left;
      margin-right: 20px;
    }

    .data-table {
      float: right;
      width: calc(100% - 280px);
    }

    .row::after {
      content: "";
      display: table;
      clear: both;
    }
  </style>
  <style>
  /* Estilos para el formulario */
  #formulario {
    max-width: 500px;
    margin: 0 auto;
    padding: 20px;
    border-radius: 10px;
  }

  /* Estilos para las etiquetas y textarea */
  label, textarea {
    display: block;
    margin-bottom: 10px;
  }

  textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
  }

  /* Estilos para el botón de enviar */
  input[type="submit"] {
    padding: 10px 20px;
    background-color: #ADF678;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
  }

  input[type="submit"]:hover {
    background-color: #D6F4BF;
  }
</style>

</head>

<body>
  <main class="container p-4 col-9" style="background-color: rgba(255, 255, 255, 0.9)">

    <div class="justificacion">
      <h1>Justificación de Ausencia</h1>
    </div>
    <table id="tabla">
      <tr>
        <th>Fecha de Ausencia</th>
        <th>Motivo</th>
        <th>Seleccionar</th>
      </tr>
      <tr>
        <td>2023-10-31</td>
        <td>Motivo de ejemplo</td>
        <td><input type="checkbox" onchange="mostrarFormulario(this)"></td>
      </tr>
    </table>

     <form id="formulario" style="display: none;">
      <label for="razon">Razón de la ausencia:</label><br>
      <textarea id="razon" name="razon" rows="4" cols="50"></textarea><br><br>
      <label for="foto">Subir foto:</label><br>
      <input type="file" id="foto" name="foto"><br><br>
      <img id="imagen" src="#" alt="Vista previa de la foto" style="display: none;"><br><br>
      <input type="submit" value="Enviar">
     </form>

  </main>

</body>

</html>