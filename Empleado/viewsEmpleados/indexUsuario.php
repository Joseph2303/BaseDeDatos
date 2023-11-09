<?php
include("../db.php");

/*if(!isset($_SESSION['tipoUsuario'])){
  header('location: ../userLogin.php');
}else{
  if($_SESSION['tipoUsuario'] != 'empleado'){
      header('location: ../userLogin.php');
  }
}*/

?>
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
    background-color: #fff;
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

  tr:nth-child(even) {
    background-color: #f2f2f2;
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
<main class="container p-4 col-9" style="background-color: rgba(255, 255, 255, 0.9);">
  <div class="row">
    <div class="col-md-10">
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

      <div class="card card-body">
        <form action="../usuario/save.php" method="POST">
          <div class="form-group">
            <input name="username" type="text" class="form-control" placeholder="Username" required>
          </div>
          <div class="form-group">
            <input name="contrasena" type="password" class="form-control" placeholder="Contraseña" required>
          </div>
          <div class="form-group">
            <input name="tipoUsuario" type="text" class="form-control" placeholder="Tipo de Usuario" required>
          </div>
          <input type="submit" name="save" class="btn btn-success btn-block" value="Guardar">
        </form>
      </div>
    </div>
    <div class="col-md-8">
      <form method="POST" action="../usuario/find.php">
        <input type="text" name="username" placeholder="Ingrese el username">
        <button type="submit" name="buscar">Buscar Usuario</button>
      </form>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Username</th>
            <th>Contraseña</th>
            <th>Tipo de Usuario</th>
            <th>Acción</th>
          </tr>
        </thead>
        <tbody>
         
         <?php
          $query = "SELECT * FROM usuario";
          $result_usuario = mysqli_query($conn, $query);

          while ($row = mysqli_fetch_assoc($result_usuario)) {
            ?>
            
            <tr>
              <td><?php echo htmlspecialchars($row['username']); ?></td>
              <td><?php echo htmlspecialchars($row['contrasena']); ?></td>
              <td><?php echo htmlspecialchars($row['tipoUsuario']); ?></td>
              <td>
                <a href="../usuario/edit.php?username=<?php echo $row['username']; ?>" class="btn btn-secondary">
                  <i class="fas fa-edit"></i>
                </a>
                <a href="../usuario/delete.php?username=<?php echo $row['username']; ?>" class="btn btn-danger">
                  <i class="fas fa-trash"></i>
                </a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</main>
