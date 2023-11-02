<?php
include("../db.php");
if (isset($_SESSION['logged_in_admin']) && $_SESSION['logged_in_admin'] === true) {
  $_SESSION['cont'] = true;
}
include('../includ/proted.php');

function consultarSolicitudVacaciones() {
  $query = "SELECT * FROM solicitudVacaciones ORDER BY idSolicitudVacaciones DESC";

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
    max-width: 650px; /* Ajusta este valor según tus necesidades */
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
    <h1 class="text-center">Solicitud De Vacaciones</h1>
      <div class="row">
        <div class="col-md-12">
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
              <div class="form-group">
              <label for="puesto">ID del empleado</label>
                  <select name="idEmpleado" class="form-control" required>
                      <option value="">Seleccione el usuario</option>
                      <?php
                      $query = "SELECT idEmpleado, nombre FROM empleado"; 
                      $stmt = $GLOBALS['conn']->query($query);
                      $empleados = $stmt->fetchAll(PDO::FETCH_ASSOC);

                      foreach ($empleados as $empleado) {
                          echo "<option value='" . htmlspecialchars($empleado['idEmpleado']) . "'> Empleado: " . htmlspecialchars($empleado['nombre']) . " - ID: " . htmlspecialchars($empleado['idEmpleado']) . "</option>";
                      }
                      ?>
                  </select>
              </div>
              <input type="submit" name="save" class="btn btn-success btn-block" value="Guardar">
            </form>
          </div>
           <form method="POST" action="SolicitudVacaciones/find.php">
            <button class="btn btn-success" type="submit" name="buscar" style="margin-top: 1rem">Buscar</button>
          </form>

        </div>
         
      </div>
    </main>
  </body>
</html>
