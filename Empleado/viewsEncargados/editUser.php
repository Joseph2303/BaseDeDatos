<?php
include("../db.php");
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
  $_SESSION['cont'] = false;
}
include('../includ/proted.php');

function consultarUsuarios()
{
  $query = "SELECT * FROM usuario ORDER BY idUsuario DESC";

  try {
    $stmt = $GLOBALS['conn']->query($query);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    return [];
  }
}

$usuarios = consultarUsuarios();
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
    max-width: 650px;

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
 
    <h1 class="text-center">Modificar Usuario</h1>
    <br>
    <div class="col-md-3">
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
      
      <div>
        <input type="text" id="buscar" oninput="filtrar()" placeholder="Buscar usuario...">
      </div>
      <br>
      <table id="tabla" class="table table-bordered">
        <thead>
          <tr>
            <th>ID Usuario</th>
            <th>Nombre de Usuario</th>
            <th>Tipo Usuario</th>
            <th>Acción</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($usuarios as $row) { ?>
            <tr>
              <td><?php echo htmlspecialchars($row['idUsuario']); ?></td>
              <td><?php echo htmlspecialchars($row['username']); ?></td>
              <td><?php echo htmlspecialchars($row['tipoUsuario']); ?></td>
              <td>

                <a href="usuario/edit.php?idUsuario=<?php echo htmlspecialchars($row['idUsuario']); ?>" class="btn btn-info">
                  <i class="fas fa-marker"></i>
                </a>
                <a href="usuario/delete.php?idUsuario=<?php echo htmlspecialchars($row['idUsuario']); ?>" class="btn btn-danger" onclick="return confirmarEliminacion();">
                  <i class="far fa-trash-alt"></i>
                </a>

              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
</main>