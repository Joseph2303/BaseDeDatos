<?php
include("../db.php");
/*if(!isset($_SESSION['tipoUsuario'])){
  header('location: ../userLogin.php');
}else{
  if($_SESSION['tipoUsuario'] != 'admin'){
      header('location: ../userLogin.php');
  }
}*/

function consultarUsuarios() {
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
    max-width: 650px; /* Ajusta este valor según tus necesidades */
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
<main class="container p-4 col-9">
  <div class="row">
  <h1 class="text-center">Editar Usuario</h1>
    <div class="col-md-3">
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
    </div>
    <div class="col-md-9">
    <form method="POST" action="usuario/find.php">
        <button class="btn btn-info " type="submit" name="buscar">Buscar</button>
      </form>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>id Usuario</th>
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
                        <!-- Cambios listo para borrar y editar probar y escribir aca
                            
                            
                        -->   
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
    </div>
  </div>

