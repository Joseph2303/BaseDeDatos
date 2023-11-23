<?php
include("../db.php");

function consultarRegistroAusentismo()
{
  $registros_por_pagina = 10;
  $pagina = isset($_GET['pagina']) && is_numeric($_GET['pagina']) ? $_GET['pagina'] : 1;
  $inicio_desde = ($pagina - 1) * $registros_por_pagina;

  $query = "SELECT * FROM (
      SELECT *, ROW_NUMBER() OVER (ORDER BY idRegistroAusentismo DESC) as row 
      FROM registroAusentismo
  ) a WHERE row > $inicio_desde AND row <= " . ($inicio_desde + $registros_por_pagina);


  try {
    $stmt = $GLOBALS['conn']->query($query);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    return [];
  }
}

$registroA = consultarRegistroAusentismo();
?>

<br>
<style>
  .container {
    margin-left: 22%;
    margin-right: 22%;
    margin-top: 1%;
  }

  .alert {
    margin-bottom: 10px;
  }

  form {
    margin-bottom: 20px;
  }

  table {
    max-width: 950px;
    border-collapse: collapse;
    width: 100%;
    margin: 0 auto;
  }

  th,
  td {
    padding: 8px;
    text-align: center;
  }

  th {
    background-color: #8CB8D7;
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
<main class="container p-4 col-9" style="background-color: rgba(255, 255, 255, 0.9)">
      <h1 class="text-center">Registro de Ausencia</h1>
    <br>
    <h3>Buscar</h3>
    <div>
      <input type="text" id="buscar" oninput="filtrar()" placeholder="Buscar registro...">
    </div>
    <br>
    <div class="col-md-12">
      <table id="tabla" class="table table-bordered">
        <thead>
          <tr>
            <th>ID Registro Ausentismo</th>
            <th>Fecha</th>
            <th>ID Empleado</th>
          </tr>
        </thead>
        <tbody>
          <?php

          foreach ($registroA as $row) {

          ?>
            <tr class="fila-paginacion">
              <td><?php echo htmlspecialchars($row['idRegistroAusentismo']); ?></td>
              <td><?php echo htmlspecialchars($row['fecha']); ?></td>
              <td><?php echo htmlspecialchars($row['idEmpleado']); ?></td>
            </tr>



          <?php }
          ?>
        </tbody>
      </table>

    </div>
</main>