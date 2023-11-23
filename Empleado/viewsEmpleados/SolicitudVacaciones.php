<?php
include("../db.php");
if (isset($_SESSION['logged_in_admin']) && $_SESSION['logged_in_admin'] === true) {
  $_SESSION['cont'] = true;
}
include('../includ/proted.php');

if (isset($_SESSION['empleadoData']) && isset($_SESSION['empleadoData']['idEmpleado'])) {

  function consultarSolicitudVacaciones()
  {
    $idEmpleado = $_SESSION['empleadoData']['idEmpleado'];
    $query = "SELECT * FROM SolicitudVacaciones where idEmpleado = $idEmpleado ORDER BY idEmpleado DESC";

    try {
      $stmt = $GLOBALS['conn']->query($query);
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $rows;
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return [];
    }
  }

  $solicitudVacaciones = consultarSolicitudVacaciones();
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
  <main class="container p-4 col-8" style="background-color: rgba(255, 255, 255, 0.9); display: flex;">
    <h3 class="text-center">Solicitud De Vacaciones</h3>
    <br>
    <div class="row">

      <div class="col-md-4">
        <!-- MESSAGES -->
        <?php if (isset($_SESSION['message'])) { ?>
          <div class="alert alert-<?= htmlspecialchars($_SESSION['message_type']) ?> alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($_SESSION['message']) ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php unset($_SESSION['message']);
        } ?>
        <div class="card card-body">
          <form action="SolicitudVacaciones/save.php" method="POST">
            <div class="form-group">
              <label>Fecha de inicio</label>
              <input name="fechInicio" type="date" class="form-control" placeholder="fechInicio" required>
            </div>
            <div class="form-group">
              <label>Fecha de finalización</label>
              <input name="fechFin" type="date" class="form-control" placeholder="fechFin" required>
            </div>

            <input type="submit" name="save" class="btn btn-success btn-block" value="Guardar">
          </form>
        </div>
      </div>



      <div class="col-md-4">

        <div>
          <input type="text" id="buscar" oninput="filtrar()" placeholder="Buscar Solicitud...">
        </div>
        <br>
        <table id="tabla">
          <thead>
            <tr>
              <th>ID de Solicitud Vacaciones</th>
              <th>Fecha de Solicitud</th>
              <th>Fecha de Inicio</th>
              <th>Fecha de Fin</th>
              <th>Estado</th>
              <th>Responsable de Autorización</th>
              <th>Descripción</th>
              <th>ID de Empleado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($solicitudVacaciones as $row) { ?>
              <tr data-id="<?php echo htmlspecialchars($row['idSolicitudVacaciones']); ?>">
                <td><?php echo htmlspecialchars($row['idSolicitudVacaciones']); ?></td>
                <td><?php echo htmlspecialchars(date('Y-m-d', strtotime($row['fechSolicitud']))); ?></td>
                <td><?php echo htmlspecialchars(date('Y-m-d', strtotime($row['fechInicio']))); ?></td>
                <td><?php echo htmlspecialchars(date('Y-m-d', strtotime($row['fechFin']))); ?></td>
                <td><?php echo htmlspecialchars($row['estado']); ?></td>
                <td><?php echo htmlspecialchars($row['responsableAut']); ?></td>
                <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
                <td><?php echo htmlspecialchars($row['idEmpleado']); ?></td>
                <td>
                  <a href="SolicitudVacaciones/editEmpleado.php?idSolicitudVacaciones=<?php echo htmlspecialchars($row['idSolicitudVacaciones']); ?>" class="btn btn-info">
                    <i class="fas fa-marker"></i>
                  </a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>


    </div>
  </main>

</html>