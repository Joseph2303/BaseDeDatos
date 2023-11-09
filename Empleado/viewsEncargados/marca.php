<?php 
include("../db.php"); 

function consultarMarca() {
    $query = "SELECT * FROM marca ORDER BY idMarca DESC";

    try {
        $stmt = $GLOBALS['conn']->query($query);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return [];
    }
}

$marcas = consultarMarca();
?>

<br>
<style>
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
  .container {
      margin-left: 22%;
      margin-right: 22%;
      margin-top: 1%;
    }
</style>
<main class="container p-4 col-9" style="background-color: rgba(255, 255, 255, 0.9)">
    <div class="row">

        <div class="col-md-3">
            
        </div>
        <h1 class="text-center">Marca</h1>

        <div class="col-md-9">
            <form method="POST" action="marcas/find.php">
                <button class="btn btn-info" type="submit" name="">Buscar </button>
            </form>
            <table class="table table-bordered">
              <thead>
                  <tr>
                      <th>ID Marca</th>
                      <th>Fecha</th>
                      <th>Tipo</th>
                      <th>ID Horario</th>
                  </tr>
              </thead>
              <tbody>
                  <?php foreach ($marcas as $row) { ?>
                      <tr>
                          <td><?php echo htmlspecialchars($row['idMarca']); ?></td>
                          <td><?php echo htmlspecialchars($row['fechaHora']); ?></td>
                          <td><?php echo htmlspecialchars($row['tipo']); ?></td>
                          <td><?php echo htmlspecialchars($row['idHorario']); ?></td>
                      </tr>
                  <?php } ?>
              </tbody>
          </table>
        </div>
    </div>
</main>