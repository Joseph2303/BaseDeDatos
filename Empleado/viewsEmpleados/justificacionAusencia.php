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
    label,
    textarea {
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

  <style>
    #formulario {
      max-width: 500px;
      margin: 0 auto;
      padding: 20px;
      background-color: #f8f8f8;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
      font-weight: bold;
      color: #333;
      font-size: 14px;
      margin-bottom: 6px;
    }

    input[type="text"],
    textarea {
      width: 100%;
      padding: 8px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    input[type="submit"] {
      background-color: #4caf50;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }
  </style>

</head>

<body>
  <main class="container p-4 col-9" style="background-color: rgba(255, 255, 255, 0.9)">

    <div class="justificacion">
      <h1>Justificación de Ausencia</h1>
    </div>
    <table id="tabla">
      </thead>
      <tr>
        <th>ID justificacion</th>
        <th>Fecha de solicitud</th>
        <th>Fecha de Ausencia</th>
        <th>Archivos</th>
        <th>Justificacion</th>
        <th>Estado</th>
        <th>Seleccionar</th>
      </tr>
      </thead>
      <tbody>
        <?php foreach ($justificacionAusencia as $row) { ?>
          <tr>
            <td><?php echo htmlspecialchars($row['idJustificacionAusencia']); ?></td>
            <td><?php echo htmlspecialchars($row['fechaSolicitud']); ?></td>
            <td><?php echo htmlspecialchars($row['fechaAusencia']); ?></td>
            <td><?php echo htmlspecialchars($row['archivos']); ?></td>
            <td><?php echo htmlspecialchars($row['justificacion']); ?></td>
            <td><?php echo htmlspecialchars($row['estado']); ?></td>
            <td><input type="checkbox" onchange="mostrarFormulario(this)"></td>
          </tr>
        <?php } ?>
      </tbody>

    </table>

    <form id="formulario" action="../justificacionAusencia/edit.php" method="POST" enctype="multipart/form-data" style="display: none;">

      <input type="hidden" id="idJustificacionAusencia" name="idJustificacionAusencia" value="<?php echo $idJustificacionAusencia; ?>">

      <label for="fechaSolicitud">Fecha de solicitud:</label>
      <input type="text" id="fechaSolicitud" name="fechaSolicitud" value="<?php echo $fechaSolicitud; ?>" readonly><br><br>

      <label for="fechaAusencia">Fecha de ausencia:</label>
      <input type="text" id="fechaAusencia" name="fechaAusencia" value="<?php echo $fechaAusencia; ?>"><br><br>

      <label for="archivos">Archivos:</label>
      <input type="file" id="archivos" name="archivos"><br><br>

      <label for="justificacion">Justificación:</label>
      <textarea id="justificacion" name="justificacion" rows="4" cols="50"><?php echo $justificacion; ?></textarea><br><br>

      <label for="estado">Estado:</label>
      <input type="text" id="estado" name="estado" value="<?php echo $estado; ?>" readonly><br><br>

      <label for="descripcion">Descripción:</label>
      <input type="text" id="descripcion" name="descripcion" value="<?php echo $descripcion; ?>" readonly><br><br>

      <label for="NombreEncargado">Nombre del encargado:</label>
      <input type="text" id="NombreEncargado" name="NombreEncargado" value="<?php echo $NombreEncargado; ?>" readonly><br><br>

      <input type="submit" value="Enviar" name="update">
    </form>

  </main>

</body>

</html>