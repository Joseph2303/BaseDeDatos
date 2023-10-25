<?php
include("../db.php");

function buscarUsuario($parametroBuscar)
{
    global $conn;

    $query = "EXEC paBuscarUsuario @parametroBuscar = :parametroBuscar";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':parametroBuscar', $parametroBuscar, PDO::PARAM_STR);

    if ($stmt->execute()) {
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return  $usuarios;
    } else {
        $_SESSION['message_danger2'] = 'Error al buscar al empleado.';
        return null;
    }
}

if (isset($_POST['buscar'])) {
    $parametroBuscar = isset($_POST['idUsuario']) ? $_POST['idUsuario'] : "";
    $usuarios = buscarUsuario($parametroBuscar);

    if (!empty($usuarios)) {
        echo '<h2>Usuarios encontrados:</h2>';
        echo '<div class="table-responsive">';
        echo '<table class="table">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Id de Usuario</th>';
        echo '<th>Nombre de Usuario</th>';
        echo '<th>Tipo de Usuario</th>';
        echo '<th>Accion</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        foreach ($usuarios as $usuario) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($usuario['idUsuario']) . '</td>';
            echo '<td>' . htmlspecialchars($usuario['username']) . '</td>';
            echo '<td>' . htmlspecialchars($usuario['tipoUsuario']) . '</td>';
            echo '<td>';
            echo '<a href="edit.php?idUsuario=' . $usuario['idUsuario'] . '" class="btn btn-info"><i class="bi bi-pencil"></i></a>&nbsp;';
            echo '<a href="delete.php?idUsuario=' . $usuario['idUsuario'] . '" class="btn btn-danger" onclick="return confirmarEliminacion(); "><i class="bi bi-trash"></i></a>';
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
    return confirm('¿Estás seguro de que deseas eliminar este empleado?');
}
</script>


 <?php
            if (isset($_SESSION['message_danger2'])) {
              echo '<div id="success-message" class="alert alert-danger">' . $_SESSION['message_danger2'] . '</div>';
              unset($_SESSION['message_danger2']);
            }
            ?>

            <script>
              setTimeout(function() {
                document.getElementById('success-message').style.display = 'none';
              }, 4000);
</script>
