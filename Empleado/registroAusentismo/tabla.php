<?php
include("../db.php");

function buscarRegistroAusentismo($parametroBuscar)
{
    global $conn;



    $sql = "EXEC paBuscarRegistroAusentismo @parametroBuscar = :parametroBuscar";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':parametroBuscar', $parametroBuscar, PDO::PARAM_STR);


    
    if ($stmt->execute()) {
        $registroA = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $registroA;
    } else {
        $_SESSION['message_danger2'] = 'Error al buscar el registro ausentismo.';
        return null;
    }
}

if (isset($_POST['buscar'])) {

  $parametroBuscar = isset($_POST['idRegistroAusentismo']) ? $_POST['idRegistroAusentismo'] : "";

  $registroA = buscarRegistroAusentismo($parametroBuscar);
  
  

  if (!empty($registroA)) {
    echo '<br>';
    echo '<h2>Registros encontrados:</h2><br>';
    echo '<div id="table" class="table-responsive">';
    echo '<table class="table">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>ID Registro Ausentismo</th>';
    echo '<th>Fecha</th>';
    echo '<th>ID Horario</th>';
    echo '<th>ID Empleado</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    foreach ($registroA as $registroA) {
      echo '<tr>';
      echo '<td>' . htmlspecialchars($registroA['idRegistroAusentismo']) . '</td>';
      echo '<td>' . htmlspecialchars($registroA['fecha']) . '</td>';
      echo '<td>' . htmlspecialchars($registroA['idHorario']) . '</td>';
      echo '<td>' . htmlspecialchars($registroA['idEmpleado']) . '</td>';
      echo '<td>';
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

  setTimeout(function() {
    document.getElementById('success-message').style.display = 'none';
  }, 9000);
</script>


