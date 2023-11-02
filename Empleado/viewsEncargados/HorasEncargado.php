<?php include("../db.php");
if (isset($_SESSION['logged_in_admin']) && $_SESSION['logged_in_admin'] === true) {
  $_SESSION['cont'] = true;
}
include('../includ/proted.php');

// Funcion de mostrar horas

function consultaExtras()
{
  $query = "SELECT * FROM horasExtra  ORDER BY idHorario DESC";

  try {
    $stmt = $GLOBALS['conn']->prepare($query);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    return [];
  }
}
$horasExtra = consultaExtras();

?>

<br>
<style>
  .container {
    margin-left: 22%;
    margin-right: 22%;
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
<<main class="container p-4 col-9" style="background-color: rgba(255, 255, 255, 0.9) ;">
  <div class="row">
    <div class="col-md-10">
      <!---->
    </div>
    <div class="col-md-10">
      <h1 class="text-center">Horas Extra</h1>
      <form method="POST" action="horasExtra/find.php">
        <button class="btn btn-success" type="submit" name="">Buscar </button>
      </form>

      <table class="table table-bordered">
        <thead>
          <tr>
            <th>ID horas extras</th>
            <th>Total de horas</th>
            <th>Cantidad de extras </th>
            <th>ID horario</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($horasExtra as $row) { ?>
            <tr>
              <td><?php echo htmlspecialchars($row['idHorasExtra']); ?></td>
              <td><?php echo htmlspecialchars($row['maxHora']); ?></td>
              <td><?php echo htmlspecialchars($row['cantidadHora']); ?></td>
              <td><?php echo htmlspecialchars($row['idHorario']); ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</main>