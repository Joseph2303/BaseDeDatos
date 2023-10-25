<?php
include("../db.php");

function mostrarEmpleadosHoraInicioDespues() {
  global $conn;

  $query = "SELECT * FROM horario WHERE CONVERT(TIME, horaInicio) > '07:05:00'";
  $stmt = $conn->prepare($query);
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

  if (count($result) > 0) {
    foreach ($result as $row) {
      $idHorario = $row['idHorario'];
      $horaInicio = $row['horaInicio'];
      $horaFin = $row['horaFin'];
      $fecha = $row['fecha'];
      $idEmpleado = $row['idEmpleado'];

      // Mostrar los detalles del empleado o realizar cualquier otra acción deseada
      echo "ID Horario: $idHorario<br>";
      echo "Hora de inicio: $horaInicio<br>";
      echo "Hora de fin: $horaFin<br>";
      echo "Fecha: $fecha<br>";
      echo "ID Empleado: $idEmpleado<br>";
      echo "<br>";
    }
  } else {
    echo "No se encontraron empleados cuya hora de inicio sea después de las 7:05.";
  }
}

// Ejemplo de uso
mostrarEmpleadosHoraInicioDespues();
?>
