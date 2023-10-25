<?php include("../db.php");

/*if(!isset($_SESSION['tipoUsuario'])){
  header('location: ../userLogin.php');
}else{
  if($_SESSION['tipoUsuario'] != 'admin'){
      header('location: ../userLogin.php');
  }
}*/
function consultarJustificacion() {
  $query = "SELECT * FROM justificacionAusencia ORDER BY idJustificacionAusencia DESC";

  try {
      $stmt = $GLOBALS['conn']->query($query);
      $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
      return $rows;
  } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
      return [];
  }
}

$justificacion = consultarJustificacion(); ?>

<html>

<head>
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
</head>

<body>

  <main class="container p-4 col-9">
    <div class="row">
      <div class="search-form col-10">
        <!-- MESSAGES -->
        <h1 class="text-center">Aprobación de justificación</h1>
        <?php if (isset($_SESSION['message'])) { ?>
        <div class="alert alert-<?= htmlspecialchars($_SESSION['message_type']) ?> alert-dismissible fade show" role="alert">
          <?= htmlspecialchars($_SESSION['message']) ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php unset($_SESSION['message']); } ?>

        <!-- Formulario para buscar justificacionAusencia -->
        <div class="col-md-9" tyle="padding-left: 2rem;">
        <form method="POST" action="justificacionAusencia/find.php" >
          <button class="btn btn-info" type="submit" name="buscar" >Buscar</button>
        </form>
        </div>
      </div>

      <div class="col-md-9"  style="padding-left: 2rem;">  
        <table class="table table-bordered" style="padding-left: 2rem;">
          <thead>
            <tr>
              <th>ID justificacionAusencia</th>
              <th>Fecha solicitud</th>
              <th>Fecha Ausente</th>
              <th>Archivos</th>
              <th>Justificacion</th>
              <th>Estado</th>
              <th>Descripcion</th>
              <th>Encargado</th>
              <th>idEmpleado</th>
              <th>Accion</th>
            </tr>
          </thead>
          <tbody>
        <?php foreach ($justificacion as $row) { ?>
            <tr>
              <td><?php echo htmlspecialchars($row['idJustificacionAusencia']); ?></td>
              <td><?php echo htmlspecialchars($row['fechaSolicitud']); ?></td>
              <td><?php echo htmlspecialchars($row['fechaAusencia']); ?></td>
              <td><?php echo htmlspecialchars($row['archivos']); ?></td>
              <td><?php echo htmlspecialchars($row['justificacion']); ?></td>
              <td><?php echo htmlspecialchars($row['estado']); ?></td>
              <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
              <td><?php echo htmlspecialchars($row['NombreEncargado']); ?></td>
              <td><?php echo htmlspecialchars($row['idEmpleado']); ?></td>
              <td>
                <a href="justificacionAusencia/edit.php?idJustificacionAusencia=<?php echo htmlspecialchars($row['idJustificacionAusencia']); ?>" class="btn btn-info">
                  <i class="fas fa-marker"></i>
                </a>
                <a href="justificacionAusencia/delete.php?idJustificacionAusencia=<?php echo htmlspecialchars($row['idJustificacionAusencia']); ?>" class="btn btn-danger " onclick="return confirmarEliminacion();">
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
</body>

</html>

