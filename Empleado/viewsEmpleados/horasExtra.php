<?php include("../db.php");

    // Funcion de mostrar horas 
    function consultaExtras($idHorario) {
        $query = "SELECT [idHorasExtra], [maxHora], [cantidadHora] FROM [proyecto_bd].[dbo].[horasExtra] WHERE [idHorario] = :idHorario";
    
        try {
            $stmt = $GLOBALS['conn']->prepare($query);
            $stmt->bindParam(':idHorario', $idHorario, PDO::PARAM_INT);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rows;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

?>



<br>
<style>
  .container {
    margin-left: 22%;
    margin-right: 22%;
  }

  .alert {
    margin-bottom: 10px;
  }

  form {
    margin-bottom: 20px;
  }

  table {
    border-collapse: collapse;
    width: 100%;
    max-width: 650px; 
  }

  th,
  td {
    padding: 8px;
    text-align: left;
  }

  th {
    background-color: #333;
    color: #fff;
  }

  button {
    padding: 8px 12px;
    background-color: #333;
    color: #fff;
    border: none;
    cursor: pointer;
  }

  button:hover {
    background-color: #555;
  }

  .btn-secondary {
    background-color: #555;
  }

  .btn-secondary:hover {
    background-color: #777;
  }

  .fa-marker {
    margin-right: 5px;
  }

  .search-form {
    float: left;
    margin-right: 20px;
  }

  .data-table {
    float: right;
    width: calc(100% - 280px);
  }

  .row::after {
    content: "";
    display: table;
    clear: both;
  }
</style>
<main class="container p-4 col-9" style="background-color: rgba(255, 255, 255, 0.9);">
    <div class="row">
        <div class="col-md-10">
            <h1 class="text-center">Horas Extra</h1>
            
            <!-- Mostrar Horas Extra del Empleado -->
            <?php
            $idHorario = 1; // Reemplaza esto con el idHorario del empleado que deseas consultar
            $horasExtra = consultaExtras($idHorario);

            if (!empty($horasExtra)) {
            ?>
            <h2>Horas Extra del Empleado</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID Horas Extra</th>
                        <th>Máxima Hora</th>
                        <th>Cantidad de Hora</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($horasExtra as $horaExtra) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($horaExtra['idHorasExtra']); ?></td>
                            <td><?php echo htmlspecialchars($horaExtra['maxHora']); ?></td>
                            <td><?php echo htmlspecialchars($horaExtra['cantidadHora']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <?php } else {
                echo "<p>No se encontraron horas extras para este empleado.</p>";
            }
            ?>
        </div>
    </div>
</main>
