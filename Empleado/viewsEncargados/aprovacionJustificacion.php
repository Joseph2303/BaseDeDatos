<?php include("../db.php");
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
  $_SESSION['cont'] = false;
}
include('../includ/proted.php');

function consultarJustificacion()
{
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

$justificacion = consultarJustificacion(); ?>
<style>
  .acciones {
    padding: 50px;
  }

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
    max-width: 950px;
  }

  th,
  td {
    padding: 8px;
    text-align: center;
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
  <h1 class="text-center">Aprobación de Ausencias</h1>

  <div class="col-10">
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

    <!-- Formulario para buscar justificacionAusencia -->

  </div>

  <br>
  <div>
    <input type="text" id="buscar" oninput="filtrar()" placeholder="Buscar justificación...">
  </div>
  <br>

  <div class="col-md-12">
    <table id="tabla" class="table table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Fecha solicitud</th>
          <th>Fecha Ausente</th>
          <th>Archivos</th>
          <th>Justificación</th>
          <th>Estado</th>
          <th>Descripción</th>
          <th>Encargado</th>
          <th>ID Empleado</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($justificacion as $row) { ?>
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
            <td>
              <a href="justificacionAusencia/edit.php?idJustificacionAusencia=<?php echo htmlspecialchars($row['idJustificacionAusencia']); ?>" class="btn btn-info">
                <i class="fas fa-marker"></i>
              </a>
              <a href="justificacionAusencia/delete.php?idJustificacionAusencia=<?php echo htmlspecialchars($row['idJustificacionAusencia']); ?>" class="btn btn-danger " onclick="return confirmarEliminacion();">
                <i class="far fa-trash-alt"></i>
              </a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</main>