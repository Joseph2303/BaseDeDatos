<?php
    include("../db.php");

        function buscarEmpleado($parametroBuscar){
              global $conn;

              $sql = "EXEC paBuscarEmpleado @parametroBuscar = :parametroBuscar";
              $stmt = $conn->prepare($sql);
          
              $stmt->bindParam(':parametroBuscar', $parametroBuscar, PDO::PARAM_STR);
          
          
              
              if ($stmt->execute()) {
                  $empleados = $stmt->fetchAll(PDO::FETCH_ASSOC);
                  return $empleados;
              } else {
                  $_SESSION['message_danger2'] = 'Error al buscar al empleado.';
                  return null;
              }
        }

        if (isset($_POST['buscar'])) {
            $parametroBuscar = isset($_POST['idEmpleado']) ? $_POST['idEmpleado'] : "";

              $empleados = buscarEmpleado($parametroBuscar);

              if ($empleados) {
                echo '<h2>Empleados encontrados:</h2>';
                echo '<div class="table-responsive">';
                echo '<table class="table">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>ID Empleado</th>';
                echo '<th>Nombre</th>';
                echo '<th>Apellido1</th>';
                echo '<th>Apellido2</th>';
                echo '<th>Email</th>';
                echo '<th>Fecha de Contratación</th>';
                echo '<th>ID de usuario</th>';
                echo '<th>Acciones</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                foreach ($empleados as $empleado) {
                  echo '<tr>';
                  echo '<td>' . htmlspecialchars($empleado['idEmpleado']) . '</td>';
                  echo '<td>' . htmlspecialchars($empleado['nombre']) . '</td>';
                  echo '<td>' . htmlspecialchars($empleado['apellido1']) . '</td>';
                  echo '<td>' . htmlspecialchars($empleado['apellido2']) . '</td>';
                  echo '<td>' . htmlspecialchars($empleado['email']) . '</td>';
                  echo '<td>' . htmlspecialchars($empleado['fechContrat']) . '</td>';
                  echo '<td>' . htmlspecialchars($empleado['idUsuario']) . '</td>';
                  echo '<td>';
                  echo '<a href="edit.php?idEmpleado=' . $empleado['idEmpleado'] . '" class="btn btn-info"><i class="bi bi-pencil"></i></a>&nbsp;';
                  echo '<a href="delete.php?idEmpleado=' . $empleado['idEmpleado'] . '" class="btn btn-danger" onclick="return confirmarEliminacion(); "> <i class="bi bi-trash"></i></a>';
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