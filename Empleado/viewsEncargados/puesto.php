<?php include("../db.php");
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
  $_SESSION['cont'] = false;
}
include('../includ/proted.php');

function consultarHorario()
{
  $query = "SELECT * FROM puesto ORDER BY idPuesto DESC";

  try {
    $stmt = $GLOBALS['conn']->query($query);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    return [];
  }
}
$puestos = consultarHorario();
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
    background-color: #5DADE2;
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
    <div class="col-5">

      <div class="col-md-12">
        <h1>Registro de Puestos</h1>

        <?php
        if (isset($_SESSION['message'])) {
          $message_type = $_SESSION['message_type'] == 'success' ? 'success' : 'danger';
          echo '<div class="alert alert-' . $message_type . '">' . $_SESSION['message'] . '</div>';
          unset($_SESSION['message']);
        }
        ?>

        <div class="card card-body ">
          <form action="Puesto/save.php" method="POST">
            <div class="form-group">
              <label for="puesto">Puesto:</label>
              <input type="text" id="puesto" name="puesto" required>
            </div>

            <button type="submit" name="save" class="btn btn-info btn-block">Guardar</button>
          </form>
        </div>
      </div>
    </div>



    <div class="col-7">

      <h2>Listado de Puestos</h2>
      <br>
      <div>
        <input type="text" id="buscar" oninput="filtrar()" placeholder="Buscar puesto...">
      </div>
      <br>
      <table id="tabla" class="table table-bordered">
        <thead>
          <tr>
            <th>ID Puesto</th>
            <th>Puesto</th>
            <th>Accion</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($puestos as $row) { ?>
            <tr>
              <td><?php echo $row['idPuesto']; ?></td>
              <td><?php echo htmlspecialchars($row['puesto']); ?></td>
              <td>
                <a href="Puesto/edit.php?idPuesto=<?php echo htmlspecialchars($row['idPuesto']); ?>" class="btn btn-info">
                  <i class="fas fa-marker"></i>
                </a>
                <a href="Puesto/delete.php?idPuesto=<?php echo htmlspecialchars($row['idPuesto']); ?>" class="btn btn-danger" onclick="return confirmarEliminacion();">
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