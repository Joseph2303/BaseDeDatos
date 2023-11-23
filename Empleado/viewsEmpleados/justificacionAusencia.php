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
      max-width: 950px;

    }

    th,
    td {
      padding: 8px;
      text-align: center;
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
    #formulario {
      max-width: 500px;
      margin: 0 auto;
      padding: 20px;
      border-radius: 10px;
    }


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




    .button {
      padding: 10px 20px;
      font-size: 16px;
    }

    .popup {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      justify-content: center;
      align-items: center;
    }

    .popup-content {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      text-align: center;
      position: relative;
    }

    .popup-cerrar {
      position: absolute;
      top: 10px;
      right: 10px;
      font-size: 24px;
      cursor: pointer;
    }
  </style>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


</head>

<body>
  <main class="container p-4 col-9" style="background-color: rgba(255, 255, 255, 0.9)">

    <div class="justificacion">
      <h1>Justificación de Ausencia</h1>
    </div>
    <br>
    <div>
      <input type="text" id="buscar" oninput="filtrar()" placeholder="Buscar justificación...">
    </div>
    <br>
    <table id="tabla">
      </thead>
      <tr>
        <th>ID justificación</th>
        <th>Fecha de solicitud</th>
        <th>Fecha de Ausencia</th>
        <th>Archivos</th>
        <th>Justificación</th>
        <th>Estado</th>
        <th>Descripción</th>
        <th>Nombre del encargado</th>
        <th>Acción</th>
      </tr>
      </thead>
      <tbody>
        <?php foreach ($justificacionAusencia as $row) { ?>
          <tr data-id="<?php echo htmlspecialchars($row['idJustificacionAusencia']); ?>">
            <td><?php echo htmlspecialchars($row['idJustificacionAusencia']); ?></td>
            <td><?php echo htmlspecialchars($row['fechaSolicitud']); ?></td>
            <td><?php echo htmlspecialchars(date('Y-m-d', strtotime($row['fechaAusencia']))); ?></td>
            <td><?php echo htmlspecialchars($row['archivos']); ?></td>
            <td><?php echo htmlspecialchars($row['justificacion']); ?></td>
            <td><?php echo htmlspecialchars($row['estado']); ?></td>
            <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
            <td><?php echo htmlspecialchars($row['NombreEncargado']); ?></td>
            <td>
              <a href="justificacionAusencia/edit2.php?idJustificacionAusencia=<?php echo htmlspecialchars($row['idJustificacionAusencia']); ?>" class="btn btn-info">
                <i class="fas fa-marker"></i>
              </a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
    <br>


    <div id="popup" class="popup">
      <div class="popup-content">
        <span class="popup-cerrar" onclick="cerrarPopup()">&times;</span>
        <h2>Tabla de Datos</h2>
        <table id="tablaDatos">
          <thead>
            <tr>
              <th>Fecha de Solicitud</th>
              <th>Fecha de Ausencia</th>
              <th>Archivos</th>
              <th>Justificación</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <!-- Aquí se llenará la tabla con datos dinámicamente -->
            <tr>
              <td>Fecha 1</td>
              <td>Fecha 2</td>
              <td>Archivo 1</td>
              <td>Justificación 1</td>
              <td>
                <button onclick="eliminarFila(this)">Eliminar</button>
                <button onclick="actualizarFila(this)">Actualizar</button>
              </td>
            </tr>
          </tbody>
        </table>

      </div>
    </div>

    <br><br>
    <br><br>

    <form id="formulario" action="justificacionAusencia/edit2.php" method="POST" enctype="multipart/form-data" style="display: none;">
      <h3>Formulario</h3>

      <input type="hidden" id="idJustificacionAusencia" name="idJustificacionAusencia" value="<?php echo $idJustificacionAusencia; ?>">

      <label for="fechaSolicitud">Fecha de solicitud:</label>
      <input type="date" id="fechaSolicitud" name="fechaSolicitud" readonly><br><br>

      <label for="fechaAusencia">Fecha de ausencia:</label>
      <input type="date" id="fechaAusencia" name="fechaAusencia" value="<?php echo $fechaAusencia; ?>" readonly><br><br>

      <label for="archivos">Archivos:</label>
      <input type="file" id="archivos" name="archivos"><br><br>

      <label for="justificacion">Justificación:</label>
      <textarea id="justificacion" name="justificacion" rows="4" cols="50"><?php echo $justificacion; ?></textarea><br><br>

      <input type="submit" value="Enviar" name="update">
    </form>
  </main>

</body>

</html>