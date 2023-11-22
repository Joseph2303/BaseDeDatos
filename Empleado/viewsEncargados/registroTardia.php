<?php include("../db.php");
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
  $_SESSION['cont'] = false;
}
include('../includ/proted.php');

function consultarHorario()
{
  $query = "SELECT * FROM horario WHERE DATEPART(HOUR, horaInicio) > 7 OR (DATEPART(HOUR, horaInicio) = 7 AND DATEPART(MINUTE, horaInicio) > 5) ORDER BY idHorario DESC";

  try {
    $stmt = $GLOBALS['conn']->query($query);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    return [];
  }
}

$horario = consultarHorario();
?>
<br>
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
    max-width: 950px;
    
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
  <div>


    <div>
      <h1 class="text-center">Registro de Tardía</h1>
      <br>
      <div>
        <input type="text" id="buscar" oninput="filtrar()" placeholder="Buscar resgistro...">
      </div>
      <br>
      <table id="tablaTardia" class="table table-bordered">
        <thead>
          <tr>
            <th>ID Horario</th>
            <th>Hora de inicio</th>
            <th>Hora de salida</th>
            <th>Fecha de tardía</th>
            <th>ID Empleado</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($horario as $row) { ?>
            <tr>
              <td><?php echo htmlspecialchars($row['idHorario']); ?></td>
              <td><?php echo htmlspecialchars($row['horaInicio']); ?></td>
              <td><?php echo htmlspecialchars($row['horaFin']); ?></td>
              <td><?php echo htmlspecialchars($row['fecha']); ?></td>
              <td><?php echo htmlspecialchars($row['idEmpleado']); ?></td>

            </tr>
          <?php } ?>
        </tbody>
      </table>
      <div id="rowsPerPageContainer"></div>
    </div>
  </div>
</main>