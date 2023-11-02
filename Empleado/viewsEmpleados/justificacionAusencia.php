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

<html>
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
  <label for="nombre">Nombre:</label>
  <input type="text" id="nombre" name="nombre"><br><br>
  <label for="razon">Razón de la ausencia:</label><br>
  <textarea id="razon" name="razon" rows="4" cols="50"></textarea><br><br>
  <input type="submit" value="Enviar">
</form>


    <script>
      
  function mostrarFormulario(checkbox) {
  var formulario = document.getElementById("formulario");

  if (checkbox.checked) {
    formulario.style.display = "block";
  } else {
    formulario.style.display = "none";
  }
}
    </script>
    
  </main>
</body>

</html>