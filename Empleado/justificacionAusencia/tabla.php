<?php
            include("../db.php");

            function buscarJustificacionAusenciaPorIdEmpleado($parametroBuscar)
            {
              global $conn;

              $sql = "EXEC paBuscarJustificacionAusencia @parametroBuscar = :parametroBuscar";
              $stmt = $conn->prepare($sql);
          
              $stmt->bindParam(':parametroBuscar', $parametroBuscar, PDO::PARAM_STR);

              if ($stmt->execute()) {
                $justificacionAusencias = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $justificacionAusencias;
            } else {
                $_SESSION['message_danger2'] = 'Error al buscar al empleado.';
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
                echo '<th>ID de justificacion</th>';
                echo '<th>Fecha de Solicitud</th>';
                echo '<th>Fecha de Ausencia</th>';
                echo '<th>Archivos</th>';
                echo '<th>Justificación</th>';
                echo '<th>Estado</th>';
                echo '<th>Descripción</th>';
                echo '<th>Nombre del Encargado</th>';
                echo '<th>ID Empleado</th>';
                echo '<th>Accion</th>';
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
                echo '<a href="delete.php?idJustificacionAusencia=' . $justificacionAusencia['idJustificacionAusencia'] . '" class="btn btn-danger" onclick="return confirmarEliminacion(); "><i class="bi bi-trash"></i></a>';
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
          <?php

          if (isset($_SESSION['message_danger2'])) {
            echo '<div id="success-message" class="alert alert-danger">' . $_SESSION['message_danger2'] . '</div>';
            unset($_SESSION['message_danger2']);
          }
          ?>
<script>
function confirmarEliminacion() {
    return confirm('¿Estás seguro de que deseas eliminar este empleado?');
}
</script>


          <script>
            setTimeout(function() {
              document.getElementById('success-message').style.display = 'none';
            }, 9000);
          </script>