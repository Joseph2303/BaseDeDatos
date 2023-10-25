<?php
include("../db.php");

function buscarFeriado($parametroBuscar)
{
    global $conn;


    $sql = "EXEC paBuscarPuesto @parametroBuscar = :parametroBuscar";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':parametroBuscar', $parametroBuscar, PDO::PARAM_STR);

    
    if ($stmt->execute()) {
        $puesto = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $puesto;
    } else {
        $_SESSION['message_danger2'] = 'Error al buscar el puesto.';
        return null;
    }
}

if (isset($_POST['buscar'])) {

  $parametroBuscar = isset($_POST['idPuesto']) ? $_POST['idPuesto'] : "";

  $puestos = buscarFeriado($parametroBuscar);
  

  if (!empty($puestos)) {
    echo '<br>';
    echo '<h2>Puesto encontrados:</h2><br>';
    echo '<div id="table" class="table-responsive">';
    echo '<table class="table">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>ID puesto</th>';
    echo '<th>Puesto</th>';
    echo '<th>ID empleado</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    foreach ($puestos as $puesto) {
      echo '<tr>';
      echo '<td>' . htmlspecialchars($puesto['idPuesto']) . '</td>';
      echo '<td>' . htmlspecialchars($puesto['puesto']) . '</td>';
      echo '<td>' . htmlspecialchars($puesto['idEmpleado']) . '</td>';
      echo '<td>';
      echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>';
  
  } else {
    echo '<div id="success-message" class="alert alert-danger">No se encontraron resultados.</div>';
    echo '<script>alert("No se encontraron resultados.");</script>';

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


