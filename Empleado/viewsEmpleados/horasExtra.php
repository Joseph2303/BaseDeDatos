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