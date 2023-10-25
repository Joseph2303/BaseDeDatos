<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>JustificacionAusencia</title>
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <!-- BOOTSTRAP 4 -->
  <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
  <!-- FONT AWESOME -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
    integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <style>
    .custom-label {
      font-weight: bold;
    }

    .custom-submit {
      margin-top: 20px;
    }

    #success-message {
      display: none;
    }
  </style>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    function confirmarEliminacion() {
      return confirm('¿Estás seguro de que deseas eliminar este registro de justificación de ausencia?');
    }

    setTimeout(function () {
      document.getElementById('success-message').style.display = 'none';
    }, 9000);
  </script>
</head>

<body
  style="background-image: url(img/fondo-degradado-tonos-verdes_23-2148387744.avif);  background-repeat:  no-repeat;  background-size: cover ;">
  <div class="container p-4">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Buscar Justificación de Ausencia</div>
          <div class="card-body">
            <form method="POST" action="">
              <div class="form-group row">
                <label for="idEmpleado" class="col-md-4 col-form-label custom-label">ID Empleado</label>
                <div class="col-md-8">
                  <input type="text" name="idEmpleado" class="form-control"
                    placeholder="Ingrese el ID del empleado">
                </div>
              </div>
              <div class="form-group row custom-submit">
                <div class="col-md-4 offset-md-4">
                  <button type="submit" name="buscar" class="btn btn-primary">Buscar</button>
                </div>
              </div>
            </form>
            <div id="resultados">
              <?php
              include("../db.php");

              function buscarJustificacionAusenciaPorIdEmpleado($parametroBuscar)
              {
                global $conn;

                $sql = "EXEC paBuscarRegistroAusentismo @parametroBuscar = :parametroBuscar";
                $stmt = $conn->prepare($sql);

                $stmt->bindParam(':parametroBuscar', $parametroBuscar, PDO::PARAM_STR);

                if ($stmt->execute()) {
                  $justificacionAusencias = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  return $justificacionAusencias;
                } else {
                  $_SESSION['message_danger2'] = 'Error al buscar la justificación de ausencia.';
                  return null;
                }
              }

              if (isset($_POST['buscar'])) {
                $parametroBuscar = isset($_POST['idEmpleado']) ? $_POST['idEmpleado'] : "";
                $justificacionAusencias = buscarJustificacionAusenciaPorIdEmpleado($parametroBuscar);

                if ($justificacionAusencias) {
                  echo '<h2>Justificación de Ausencia encontrada:</h2>';
                  echo '<div class="table-responsive">';
                  echo '<table class="table">';
                  echo '<thead>';
                  echo '<tr>';
                  echo '<th>ID de Justificación</th>';
                  echo '<th>Fecha de Solicitud</th>';
                  echo '<th>Fecha de Ausencia</th>';
                  echo '<th>Archivos</th>';
                  echo '<th>Justificación</th>';
                  echo '<th>Estado</th>';
                  echo '<th>Descripción</th>';
                  echo '<th>Nombre del Encargado</th>';
                  echo '<th>ID Empleado</th>';
                  echo '<th>Acción</th>';
                  echo '</tr>';
                  echo '</thead>';
                  echo '<tbody>';

                  foreach ($justificacionAusencias as $justificacionAusencia) {

                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($justificacionAusencia['idJustificacionAusencia']) . '</td>';
                    echo '<td>' . htmlspecialchars($justificacionAusencia['fechaSolicitud']) . '</td>';
                    echo '<td>' . htmlspecialchars($justificacionAusencia['fechaAusencia']) . '</td>';
                    echo '<td>' . htmlspecialchars($justificacionAusencia['archivos']) . '</td>';
                    echo '<td>' . htmlspecialchars($justificacionAusencia['justificacion']) . '</td>';
                    echo '<td>' . htmlspecialchars($justificacionAusencia['estado']) . '</td>';
                    echo '<td>' . htmlspecialchars($justificacionAusencia['descripcion']) . '</td>';
                    echo '<td>' . htmlspecialchars($justificacionAusencia['NombreEncargado']) . '</td>';
                    echo '<td>' . htmlspecialchars($justificacionAusencia['idEmpleado']) . '</td>';
                    echo '<td>';
                    echo '<a href="edit.php?idJustificacionAusencia=' . $justificacionAusencia['idJustificacionAusencia'] . '" class="btn btn-info"><i class="bi bi-pencil"></i></a>&nbsp;';
                    echo '<a href="delete.php?idJustificacionAusencia=' . $justificacionAusencia['idJustificacionAusencia'] . '" class="btn btn-danger" onclick="return confirmarEliminacion();"><i class="bi bi-trash"></i></a>';
                    echo '</td>';
                    echo '</tr>';
                  }
                  echo '</tbody>';
                  echo '</table>';
                  echo '</div>';
                } else {
                  echo '<div id="success-message" class="alert alert-danger">No se encontraron resultados.</div>';
                }
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
