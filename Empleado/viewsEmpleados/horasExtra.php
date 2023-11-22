<?php include("../db.php");
if (isset($_SESSION['logged_in_admin']) && $_SESSION['logged_in_admin'] === true) {
  $_SESSION['cont'] = true;
}
include('../includ/proted.php');

function consultaExtras()
{
  $query = "SELECT * FROM horasExtra  ORDER BY idHorasExtra DESC";

  try {
    $stmt = $GLOBALS['conn']->prepare($query);
    $stmt->execute();
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
<<main class="container p-4 col-9" style="background-color: rgba(255, 255, 255, 0.9) ;">

      <h1 class="text-center">Horas Extras</h1>
      <br>
      <div>
        <input type="text" id="buscar" oninput="filtrar()" placeholder="Buscar horas extra...">
      </div>
      <br>
      <table id="tabla" class="table table-bordered">
        <thead>
          <tr>
            <th>ID horas extras</th>
            <th>Total de horas</th>
            <th>Cantidad de extras </th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($horasExtra as $row) { ?>
            <tr>
              <td><?php echo htmlspecialchars($row['idHorasExtra']); ?></td>
              <td><?php echo htmlspecialchars($row['maxHora']); ?></td>
              <td><?php echo htmlspecialchars($row['cantidadHora']); ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
  </main>