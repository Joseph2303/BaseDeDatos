
<?php include("../db.php");
/*if(!isset($_SESSION['tipoUsuario'])){
  header('location: ../userLogin.php');
}else{
  if($_SESSION['tipoUsuario'] != 'empleado'){
      header('location: ../userLogin.php');
  }
}*/
function consultarDiasFeriados() {
  $query = "SELECT * FROM diasferiados ORDER BY idDiasFeriados DESC";

  try {
      $stmt = $GLOBALS['conn']->query($query);
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $rows;
  } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return [];
  }
}

$diasFeriados = consultarDiasFeriados();
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
    background-color: #333;
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
<main class="container p-4 col-9" style="background-color: rgba(255, 255, 255, 0.9) ;">
    <div class="row">
        <div class="col-md-10">
            <!---->
        </div>
        <div class="col-md-10">
        <h1 class="text-center">Días Feriados</h1>
            <form method="POST" action="diasFeriados/find.php">
                <button class="btn btn-success" type="submit" name="">Buscar </button>
            </form>

            <table class="table table-bordered">
                <thead>
                    <tr>
                    <th>ID de dias Feriado</th>
                        <th>Dia Feriado</th>
                        <th>Descripcion</th>
                        <th>Tipo De Feriado</th>
                    </tr>
                </thead>
                <tbody>
                  <?php foreach ($diasFeriados as $row) { ?>
                      <tr>
                          <td><?php echo htmlspecialchars($row['idDiasFeriados']); ?></td>
                          <td><?php echo htmlspecialchars($row['fecha']); ?></td>
                          <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
                          <td><?php echo htmlspecialchars($row['tipoFeriado']); ?></td>
                      </tr>
                  <?php } ?>
              </tbody>
            </table>
        </div>
    </div>
</main>