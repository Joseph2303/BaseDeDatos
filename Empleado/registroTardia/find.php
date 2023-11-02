<?php
include("../db.php");

function buscarRegistroTardia($parametroBuscar)
{
    global $conn;



    $sql = "EXEC paBuscarRegistroTardia @parametroBuscar = :parametroBuscar";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':parametroBuscar', $parametroBuscar, PDO::PARAM_STR);


    
    if ($stmt->execute()) {
        $registroT = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $registroT;
    } else {
        $_SESSION['message_danger2'] = 'Error al buscar el registro.';
        return null;
    }
}

if (isset($_POST['buscar'])) {

  $parametroBuscar = isset($_POST['idRegistroTardia']) ? $_POST['idRegistroTardia'] : "";

  $registroT = buscarRegistroTardia($parametroBuscar);
  
  

  if (!empty($registroT)) {
    echo '<br>';
    echo '<h2>Registros encontrados:</h2><br>';
    echo '<div id="table" class="table-responsive">';
    echo '<table class="table">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>ID Registro Tardia</th>';
    echo '<th>Fecha</th>';
    echo '<th>Tipo</th>';
    echo '<th>Cantidad de Minutos</th>';
    echo '<th>ID Horario</th>';
    echo '<th>ID Empleado</th>';
    echo '<th>ID Marca</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    foreach ($registroT as $registroT) {
      echo '<tr>';
      echo '<td>' . htmlspecialchars($registroT['idRegistroTardia']) . '</td>';
      echo '<td>' . htmlspecialchars($registroT['fecha']) . '</td>';
      echo '<td>' . htmlspecialchars($registroT['tipoTardia']) . '</td>';
      echo '<td>' . htmlspecialchars($registroT['CantMinutos']) . '</td>';
      echo '<td>' . htmlspecialchars($registroT['idHorario']) . '</td>';
      echo '<td>' . htmlspecialchars($registroT['idEmpleado']) . '</td>';
      echo '<td>' . htmlspecialchars($registroT['idMarca']) . '</td>';
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