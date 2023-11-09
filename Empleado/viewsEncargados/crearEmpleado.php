<?php include("../db.php");
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
  $_SESSION['cont'] = false;
}
include('../includ/proted.php');


function consultarEmpleados() {
  $query = "SELECT * FROM empleado ORDER BY idEmpleado DESC";

  try {
      $stmt = $GLOBALS['conn']->query($query);
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $rows;
  } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return [];
  }
}

$empleados = consultarEmpleados(); ?>
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
    /* Ajusta este valor según tus necesidades */
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
<main class="container p-4 col-10">
  <div class="row">
    <div class="col-3">
    <h1 class="text-center">Crear Empleado</h1>
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

      <?php if (isset($_SESSION['username_error'])) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          El nombre de usuario es incorrecto. Por favor, verifícalo.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php unset($_SESSION['username_error']);
      } ?>

      <div class="card card-body">
        <form action="empleado/save.php" method="POST">
          <div class="form-group">
            <label>Nombre del Empleado</label>
            <input name="nombre" type="text" class="form-control" placeholder="Nombre del Empleado" required>
          </div>
          <div class="form-group">
            <label>Primer apellido</label>
            <input name="apellido1" type="text" class="form-control" placeholder="Apellido del Empleado" required>
          </div>
          <div class="form-group">
            <label>Segundo apellido</label>
            <input name="apellido2" type="text" class="form-control" placeholder="Apellido del Empleado" required>
          </div>

          <div class="form-group">
            <label>Email del Empleado</label>
            <input name="email" type="email" class="form-control" placeholder="Email" required>
          </div>
          <div class="form-group">
            <label>Fecha de contratación</label>
            <input name="fechContrat" type="date" class="form-control" required>
          </div>
           <div class="form-group">
              <label for="puesto">Puesto del Empleado</label>
                  <select name="idPuesto" class="form-control" required>
                      <option value="">Seleccione el puesto</option>
                      <?php
                      $query = "SELECT idPuesto, puesto FROM puesto"; 
                      $stmt = $GLOBALS['conn']->query($query);
                      $puestos = $stmt->fetchAll(PDO::FETCH_ASSOC);

                      foreach ($puestos as $puesto) {
                          echo "<option value='" . htmlspecialchars($puesto['idPuesto']) . "'> Puesto: " . htmlspecialchars($puesto['puesto']) . " - ID: " . htmlspecialchars($puesto['idPuesto']) . "</option>";
                      }
                      ?>
                  </select>
            </div>


          <div class="form-group">
            <label>Username del Empleado</label>
            <input name="username" type="text" class="form-control" placeholder="Username" required>
          </div>
          <input type="submit" name="save" class="btn btn-info" value="Guardar">
        </form>
      </div>
    </div>
    <div class="col-md-3">
      <!-- Formulario para buscar empleado -->
      <form action="empleado/save.php" method="POST">
        <button class="btn btn-info" style="margin-top: 2.5rem;" type="submit" name="buscar">Buscar</button>
      </form>

      <table class="table table-bordered" >
        <thead>
          <tr>
            <th>ID Empleado</th>
            <th>Nombre</th>
            <th>Apellido1</th>
            <th>Apellido2</th>
            <th>Email</th>
            <th>Fecha de contratación</th>
            <th>Username</th>
            <th>Puesto</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($empleados as $row) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['idEmpleado']); ?></td>
                <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                <td><?php echo htmlspecialchars($row['apellido1']); ?></td>
                <td><?php echo htmlspecialchars($row['apellido2']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['fechContrat']); ?></td>
                <td><?php echo htmlspecialchars($row['idUsuario']); ?></td>
                <td><?php echo htmlspecialchars($row['idPuesto']); ?></td> 
                <td>
                    <a href="empleado/edit.php?idEmpleado=<?php echo htmlspecialchars($row['idEmpleado']); ?>" class="btn btn-info">
                        <i class="fas fa-marker"></i>
                    </a>
                    <a href="empleado/delete.php?idEmpleado=<?php echo htmlspecialchars($row['idEmpleado']); ?>" class="btn btn-danger" onclick="return confirmarEliminacion()">
                        <i class="bi bi-trash"></i>
                    </a>


                </td>
            </tr>
        <?php } ?>

    </tbody>
    
      </table>
    </div>
  </div>
</main>