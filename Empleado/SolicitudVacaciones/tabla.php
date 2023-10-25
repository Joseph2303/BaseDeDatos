<?php
            include("../db.php");

            function buscarSolicitudVacacionesPorIdEmpleado($parametroBuscar)
            {
                global $conn;

                $sql = "EXEC paBuscarSolicitudVacaciones @parametroBuscar = :parametroBuscar";
                $stmt = $conn->prepare($sql);
            
                $stmt->bindParam(':parametroBuscar', $parametroBuscar, PDO::PARAM_STR);

                if ($stmt->execute()) {
                    $solicitudVacaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                    return $solicitudVacaciones;
                } else {
                  echo '<div id="success-message" class="alert alert-danger">No se encontraron resultados.</div>';

                    $_SESSION['message_danger2'] = 'Error al buscar el feriado.';
                    return null;
                }
            }

            if (isset($_POST['buscar'])) {

              $parametroBuscar = isset($_POST['idSolicitudVacaciones']) ? $_POST['idSolicitudVacaciones'] : "";

              $solicitudesVacaciones = buscarSolicitudVacacionesPorIdEmpleado($parametroBuscar);

              if ($solicitudesVacaciones) {
                echo '<h2>Solicitudes de Vacaciones encontradas:</h2>';
                echo '<div class="table-responsive">';
                echo '<table class="table">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>ID de Solicitud</th>';
                echo '<th>Fecha de Solicitud</th>';
                echo '<th>Fecha de Inicio</th>';
                echo '<th>Fecha de Fin</th>';
                echo '<th>Estado</th>';
                echo '<th>Responsable de Autorización</th>';
                echo '<th>Descripción</th>';
                echo '<th>ID Empleado</th>';
                echo '<th>Accion</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                foreach ($solicitudesVacaciones as $solicitud) {
                  echo '<tr>';
                  echo '<td>' . htmlspecialchars($solicitud['idSolicitudVacaciones']) . '</td>';
                  echo '<td>' . htmlspecialchars($solicitud['fechSolicitud']) . '</td>';
                  echo '<td>' . htmlspecialchars($solicitud['fechInicio']) . '</td>';
                  echo '<td>' . htmlspecialchars($solicitud['fechFin']) . '</td>';
                  echo '<td>' . htmlspecialchars($solicitud['estado']) . '</td>';
                  echo '<td>' . htmlspecialchars($solicitud['responsableAut']) . '</td>';
                  echo '<td>' . htmlspecialchars($solicitud['descripcion']) . '</td>';
                  echo '<td>' . htmlspecialchars($solicitud['idEmpleado']) . '</td>';
                  echo '<td>';
                  echo '<a href="edit.php?idSolicitudVacaciones=' . $solicitud['idSolicitudVacaciones'] . '" class="btn btn-info"><i class="bi bi-pencil"></i></a>&nbsp;';
                  echo '<a href="delete.php?idSolicitudVacaciones=' . $solicitud['idSolicitudVacaciones'] . '" class="btn btn-danger" onclick="return confirmarEliminacion(); "><i class="bi bi-trash"></i></a>';
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
          <script>
        function confirmarEliminacion() {
        return confirm('¿Estás seguro de que deseas eliminar este día feriado?');

        }
          setTimeout(function() {
            document.getElementById('success-message').style.display = 'none';
          }, 9000);
        </script>