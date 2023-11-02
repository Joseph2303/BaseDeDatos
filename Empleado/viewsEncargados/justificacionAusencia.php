<?php
include("../db.php");

function consultarJustificacionesAusencia() {
  $query = "SELECT * FROM justificacionAusencia ORDER BY idJustificacionAusencia DESC";

  try {
      $stmt = $GLOBALS['conn']->query($query);
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $rows;
  } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return [];
  }
}

$justificacionesAusencia = consultarJustificacionesAusencia();
?>
<style>
.container {
  margin-left: 22%;
    margin-right: 22%;
    margin-top: 1%;
    background-color: rgba(255, 255, 255, 0.9);
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
}

th,
td {
  padding: 8px;
  text-align: left;
}

th {
  background-color: #8CB8D7;
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
<main class="container p-4 col-9">
  <div class="row">
    <div class="col-10">
      <!-- MESSAGES -->
      <h1 class="text-center">Justificaciones de Ausencia</h1>
      <?php if (isset($_SESSION['message'])) { ?>
        <div class="alert alert-<?= htmlspecialchars($_SESSION['message_type']) ?> alert-dismissible fade show" role="alert">
          <?= htmlspecialchars($_SESSION['message']) ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php unset($_SESSION['message']);
      } ?>
    </div>
    <div class="col-md-9">
      <form method="POST" action="JustificacionAusencia/find.php">
        <button class="btn btn-info" type="submit" name="buscar">Buscar</button>
      </form>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID de Justificación Ausencia</th>
            <th>Fecha Solicitud</th>
            <th>Fecha de Ausencia</th>
            <th>Archivos</th>
            <th>Justificación</th>
            <th>Estado</th>
            <th>Descripción</th>
            <th>Nombre del Encargado</th>
            <th>ID Empleado</th>
            <th>ID Registro Ausentismo</th>
            <th>Acción</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($justificacionesAusencia as $row) { ?>
          <tr>
            <td><?php echo htmlspecialchars($row['idJustificacionAusencia']); ?></td>
            <td><?php echo htmlspecialchars($row['fechaSolicitud']); ?></td>
            <td><?php echo htmlspecialchars($row['fechaAusencia']); ?></td>
            <td><?php echo htmlspecialchars($row['archivos']); ?></td>
            <td><?php echo htmlspecialchars($row['justificacion']); ?></td>
            <td><?php echo htmlspecialchars($row['estado']); ?></td>
            <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
            <td><?php echo htmlspecialchars($row['NombreEncargado']); ?></td>
            <td><?php echo htmlspecialchars($row['idEmpleado']); ?></td>
            <td><?php echo htmlspecialchars($row['idRegistroAusentismo']); ?></td>

            <td>
              <a href="JustificacionAusencia/edit.php?idJustificacionAusencia=<?php echo htmlspecialchars($row['idJustificacionAusencia']); ?>" class="btn btn-info">
                <i class="fas fa-marker"></i>
              </a>
              <a href="JustificacionAusencia/delete.php?idJustificacionAusencia=<?php echo htmlspecialchars($row['idJustificacionAusencia']); ?>" class="btn btn-danger" onclick="return confirmarEliminacion();">
                <i class="far fa-trash-alt"></i>
              </a>
            </td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</main>
