<?php
include("../db.php");

function buscarHoras($parametroBuscar)
{
    global $conn;

    $sql = "EXEC paCalcularHorasExtras @parametroBuscar = :parametroBuscar";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':parametroBuscar', $parametroBuscar, PDO::PARAM_STR);




    if ($stmt->execute()) {
        $horasExtra = $stmt->fetch(PDO::FETCH_ASSOC);
        return $horasExtra;
    } else {
        $_SESSION['message_danger2'] = 'Error al calcular las horas extra.';
        return null;
    }
}

if (isset($_POST['buscar'])) {

    $parametroBuscar = isset($_POST['idHorasExtra']) ? $_POST['idHorasExtra'] : "";
  
    $horasExtra = buscarHoras($parametroBuscar);
    
    
  
    if (!empty($horasExtra)) {
      echo '<br>';
      echo '<h2>Horas Extra encontrados:</h2><br>';
      echo '<div id="table" class="table-responsive">';
      echo '<table class="table">';
      echo '<thead>';
      echo '<tr>';
      echo '<th>ID Horas Extras</th>';
      echo '<th>maximo de horas</th>';
      echo '<th>Cantidad de horas</th>';
      echo '<th>ID horario</th>';
      echo '</tr>';
      echo '</thead>';
      echo '<tbody>';
  
      foreach ($horasExtra as $horasExtra) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($horasExtra['idHorasExtra']) . '</td>';
        echo '<td>' . htmlspecialchars($horasExtra['maxHora']) . '</td>';
        echo '<td>' . htmlspecialchars($horasExtra['cantidadHora']) . '</td>';
        echo '<td>' . htmlspecialchars($horasExtra['idHorario']) . '</td>';
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
