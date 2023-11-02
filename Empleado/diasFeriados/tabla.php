<?php
include("../db.php");

function buscarFeriado($parametroBuscar)
{
    global $conn;

    $sql = "EXEC paBuscarDiasFeriado @parametroBuscar = :parametroBuscar";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':parametroBuscar', $parametroBuscar, PDO::PARAM_STR);


    
    if ($stmt->execute()) {
        $feriados = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $feriados;

    } else {
        $_SESSION['message_danger2'] = 'Error al buscar el feriado.';
        return null;
    }
}

if (isset($_POST['buscar'])) {

  $parametroBuscar = isset($_POST['idDiasFeriados']) ? $_POST['idDiasFeriados'] : "";

  $feriados = buscarFeriado($parametroBuscar);
  
  

  if (!empty($feriados)) {
    echo '<br>';
    echo '<h2>Días Feriados encontrados:</h2><br>';
    echo '<div id="table" class="table-responsive">';
    echo '<table class="table">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>ID Día Feriado</th>';
    echo '<th>Fecha</th>';
    echo '<th>Descripción</th>';
    echo '<th>Tipo de Feriado</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    foreach ($feriados as $feriado) {
      echo '<tr>';
      echo '<td>' . htmlspecialchars($feriado['idDiasFeriados']) . '</td>';
      echo '<td>' . htmlspecialchars($feriado['fecha']) . '</td>';
      echo '<td>' . htmlspecialchars($feriado['descripcion']) . '</td>';
      echo '<td>' . htmlspecialchars($feriado['tipoFeriado']) . '</td>';
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
function confirmarEliminacion() {
return confirm('¿Estás seguro de que deseas eliminar este día feriado?');

}
  setTimeout(function() {
    document.getElementById('success-message').style.display = 'none';
  }, 9000);
</script>


