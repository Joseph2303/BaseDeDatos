<?php
            include("../db.php");

            function buscarHorarioPorEmpleado($parametroBuscar)
            {
              global $conn;

              //$query = "SELECT * FROM horario WHERE parametroBuscar = ? AND horaInicio > '07:05:00'";
              $query = "EXEC paBuscarHorario @parametroBuscar = :parametroBuscar";

              $stmt = $conn->prepare($query);
              $stmt->bindParam(1, $parametroBuscar, PDO::PARAM_STR);
              $stmt->execute();
              $horarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

              return $horarios;
            }

            if (isset($_POST['buscar'])) {
              $parametroBuscar = isset($_POST['idEmpleado']) ? $_POST['idEmpleado'] : "";
              $horarios = buscarHorarioPorEmpleado($parametroBuscar);

              if ($horarios) {
                echo '<h2>Horarios encontrados:</h2>';
                echo '<div class="table-responsive">';
                echo '<table class="table">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>ID Horario</th>';
                echo '<th>Hora de Inicio</th>';
                echo '<th>Hora de Fin</th>';
                echo '<th>Fecha</th>';
                echo '<th>ID Empleado</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                foreach ($horarios as $horario) {
                  echo '<tr>';
                  echo '<td>' . htmlspecialchars($horario['idHorario']) . '</td>';
                  echo '<td>' . htmlspecialchars($horario['horaInicio']) . '</td>';
                  echo '<td>' . htmlspecialchars($horario['horaFin']) . '</td>';
                  echo '<td>' . htmlspecialchars($horario['fecha']) . '</td>';
                  echo '<td>' . htmlspecialchars($horario['idEmpleado']) . '</td>';
                  echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';
                echo '</div>';
              } else {
                echo '<div class="alert alert-danger">Error, no se encontraron horarios para el ID empleado especificado.</div>';
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