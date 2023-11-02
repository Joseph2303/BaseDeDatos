<?php
include("../db.php");

function buscarMarca($parametroBuscar)
{
    global $conn;

    // Revisar el nombre del PA en la base 

    $sql = "EXEC paBuscarMarca @parametroBuscar = :parametroBuscar";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':parametroBuscar', $parametroBuscar, PDO::PARAM_STR);


    
    if ($stmt->execute()) {
        $marcas = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $marcas;
    } else {
        $_SESSION['message_danger2'] = 'Error al buscar la marca.';
        return null;
    }
}

if (isset($_POST['buscar'])) {

  $parametroBuscar = isset($_POST['idMarca']) ? $_POST['idMarca'] : "";

  $marcas = buscarMarca($parametroBuscar);
  
  

  if (!empty($marcas)) {
    echo '<br>';
    echo '<h2>Marcas encontradas:</h2><br>';
    echo '<div id="table" class="table-responsive">';
    echo '<table class="table">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>ID Marca</th>';
    echo '<th>Fecha</th>';
    echo '<th>Tipo</th>';
    echo '<th>ID Horario</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    foreach ($marcas as $marcas) {
      echo '<tr>';
      echo '<td>' . htmlspecialchars($marcas['idMarca']) . '</td>';
      echo '<td>' . htmlspecialchars($marcas['fechaHora']) . '</td>';
      echo '<td>' . htmlspecialchars($marcas['tipo']) . '</td>';
      echo '<td>' . htmlspecialchars($marcas['idHorario']) . '</td>';
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


