
<?php 
include("../db.php"); 

function consultarRegistroAusentismo() {
    $query = "SELECT * FROM registroAusentismo ORDER BY idRegistroAusentismo DESC";

    try {
        $stmt = $GLOBALS['conn']->query($query);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return [];
    }
}

$registroA = consultarRegistroAusentismo();
?>

<br>
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
<main class="container p-4 col-9" style="background-color: rgba(255, 255, 255, 0.9)">
    <div class="row">

        <div class="col-md-3">
            <!---->
        </div>
        <div class="col-md-9">
            <form method="POST" action="registroAusentismo/find.php">
                <button class="btn btn-info" type="submit" name="">Buscar </button>
            </form>
            <table class="table table-bordered">
              <thead>
                  <tr>
                      <th>ID Registro Ausentismo</th>
                      <th>Fecha</th>
                      <th>ID Horario</th>
                      <th>ID Empleado</th>
                  </tr>
              </thead>
              <tbody>
                  <?php foreach ($registroA as $row) { ?>
                      <tr>
                          <td><?php echo htmlspecialchars($row['idRegistroAusentismo']); ?></td>
                          <td><?php echo htmlspecialchars($row['fecha']); ?></td>
                          <td><?php echo htmlspecialchars($row['idHorario']); ?></td>
                          <td><?php echo htmlspecialchars($row['idEmpleado']); ?></td>
                      </tr>
                  <?php } ?>
              </tbody>
          </table>
        </div>
    </div>
</main>