<?php
include("../db.php");
$searchValue = $_GET['searchValue'];
$query = "SELECT * FROM diasFeriados WHERE descripcion LIKE '%$searchValue%' ORDER BY idDiasFeriados DESC";


try {
    $stmt = $GLOBALS['conn']->query($query);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($rows as $row) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['fecha']) . "</td>";
        echo "<td>" . htmlspecialchars($row['descripcion']) . "</td>";
        echo "<td>" . htmlspecialchars($row['tipoFeriado']) . "</td>";
        echo "</tr>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}



?>




