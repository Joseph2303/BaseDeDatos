<?php
include("../db.php");

function consultarJustificacionesAusencia()
{
    $query = "SELECT * FROM justificacionTardia ORDER BY idJustificacionTardia DESC";

    try {
        $stmt = $GLOBALS['conn']->query($query);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return [];
    }
}

$justificacionesAusencia = consultarJustificacionesAusencia();
?>
<style>
    .container {
        margin-left: 22%;
        margin-right: 22%;
        margin-top: 1%;
        background-color: rgba(255, 255, 255, 0.9);
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
        max-width: 850px;
    }

    .center-table {
        margin: 0 auto;
        /* Centra la tabla horizontalmente */
    }

    th,
    td {
        padding: 8px;
        text-align: left;
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

<main class="container p-4 col-9">
    <div class="row">
        <div class="col-10">
            <!-- MESSAGES -->
            <h1 class="text-center">Justificaciones de Tardia</h1>
            <?php if (isset($_SESSION['message'])) { ?>
                <div class="alert alert-<?= htmlspecialchars($_SESSION['message_type']) ?> alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_SESSION['message']) ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php unset($_SESSION['message']);
            } ?>
        </div>

        <div class="col-md-12">

            <br>
            <div>
                <input type="text" id="buscar" oninput="filtrar()" placeholder="Buscar justificacion...">
            </div>
            <br>
            <table id="tabla" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID de Justificación tardía</th>
                        <th>Fecha</th>
                        <th>Justificacion de Tardía</th>
                        <th>Documentacion</th>
                        <th>Revisión</th>
                        <th>ID Registro Tardía</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($justificacionesAusencia as $row) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['idJustificacionTardia']); ?></td>
                            <td><?php echo htmlspecialchars($row['fecha']); ?></td>
                            <td><?php echo htmlspecialchars($row['justiTardia']); ?></td>
                            <td><?php echo htmlspecialchars($row['documento']); ?></td>
                            <td><?php echo htmlspecialchars($row['revision']); ?></td>
                            <td><?php echo htmlspecialchars($row['idRegistroTardia']); ?></td>


                            <td>
                                <a href="JustificacionTardia/edit.php?idJustificacionTardia=<?php echo htmlspecialchars($row['idJustificacionTardia']); ?>" class="btn btn-info">
                                    <i class="fas fa-marker"></i>
                                </a>
                                <a href="JustificacionTardia/delete.php?idJustificacionTardia=<?php echo htmlspecialchars($row['idJustificacionTardia']); ?>" class="btn btn-danger" onclick="return confirmarEliminacion();">
                                    <i class="far fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</main>