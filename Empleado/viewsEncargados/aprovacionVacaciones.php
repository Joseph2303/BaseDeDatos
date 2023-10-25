<?php
include("../db.php");
/*if(!isset($_SESSION['tipoUsuario'])){
  header('location: ../userLogin.php');
}else{
  if($_SESSION['tipoUsuario'] != 'admin'){
      header('location: ../userLogin.php');
  }
}*/
function consultarSolicitudesVacaciones() {
  $query = "SELECT * FROM solicitudVacaciones ORDER BY idSolicitudVacaciones DESC";

  try {
      $stmt = $GLOBALS['conn']->query($query);
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $rows;
  } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return [];
  }
}

$solicitudesVacaciones = consultarSolicitudesVacaciones();
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
    
    <div class="col-10">
      <!-- MESSAGES -->
      <h1 class="text-center">Aprobación de Vacaciones</h1>
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
    <form method="POST" action="SolicitudVacaciones/find.php">
        <button class="btn btn-info " type="submit" name="buscar">Buscar</button>
      </form>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Id Solicitud Vacaciones</th>
            <th>Fecha Solicitud</th>
            <th>FechInicio</th>
            <th>Fecha Fin</th>
            <th>Estado</th>
            <th>Responsable</th>
            <th>Descripcion</th>
            <th>Id Empleado</th>
            <th>Acción</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($solicitudesVacaciones as $row) { ?>
            <tr>
            <td><?php echo htmlspecialchars($row['idSolicitudVacaciones']); ?></td>
                <td><?php echo htmlspecialchars($row['fechSolicitud']); ?></td>
                <td><?php echo htmlspecialchars($row['fechInicio']); ?></td>
                <td><?php echo htmlspecialchars($row['fechFin']); ?></td>
                <td><?php echo htmlspecialchars($row['estado']); ?></td>
                <td><?php echo htmlspecialchars($row['responsableAut']); ?></td>
                <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
                <td><?php echo htmlspecialchars($row['idEmpleado']); ?></td>
                <td>
                    <a href="SolicitudVacaciones/edit.php?idSolicitudVacaciones=<?php echo htmlspecialchars($row['idSolicitudVacaciones']); ?>" class="btn btn-info">
                        <i class="fas fa-marker"></i>
                    </a>
                    <a href="SolicitudVacaciones/delete.php?idSolicitudVacaciones=<?php echo htmlspecialchars($row['idSolicitudVacaciones']); ?>" class="btn btn-danger" onclick="return confirmarEliminacion();">
                        <i class="far fa-trash-alt"></i>
                    </a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
      </table>
    </div>
  </div>

