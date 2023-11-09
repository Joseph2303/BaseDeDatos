<?php
include("../db.php");
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    $_SESSION['cont'] = false;
}

include('../includ/proted.php');

function consultarDiasFeriados()
{
    $query = "SELECT * FROM diasFeriados ORDER BY idDiasFeriados DESC";

    try {
        $stmt = $GLOBALS['conn']->query($query);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return [];
    }
}

$feriados = consultarDiasFeriados();
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
        max-width: 650px;
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

<main class="container p-4 col-8">

    <div class="row">
        <div class="col-4">
            <h1 class="text-center">Dias Feriados</h1>
            <!-- MESSAGES -->
            <?php if (isset($_SESSION['message'])) { ?>
                <div class="alert alert-<?= htmlspecialchars($_SESSION['message_type']) ?> alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_SESSION['message']) ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php unset($_SESSION['message']);
            } ?>

            <div class="card card-body">
                <form action="diasFeriados/save.php" method="POST">
                    <div class="form-group">
                        <label>Fecha</label>
                        <input name="fecha" type="date" class="form-control" placeholder="Fecha" required>
                    </div>

                    <div class="form-group">
                        <label>Descripción</label>
                        <input name="descripcion" type="text" class="form-control" placeholder="Descripción" required>
                    </div>

                    <div class="form-group">
                        <label>Tipo de día feriado</label>
                        <select name="tipoFeriado" class="form-control" required>
                            <option value="">Seleccione el tipo</option>
                            <option value="obligatorio">Pago Obligatorio</option>
                            <option value="no obligatorio">Pago No Obligatorio</option>
                        </select>
                    </div>

                    <input class="btn btn-info btn-block" type="submit" name="save" value="Guardar">
                </form>
            </div>
        </div>

        <div class="col-md-8">
            <form method="POST" action="diasFeriados/find.php">
                <button class="btn btn-info " style="margin-top: 2.5rem;" type="submit" name="">Buscar</button>
            </form>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>id Dia Feriado</th>
                        <th>Fecha</th>
                        <th>Descripción</th>
                        <th>Tipo de Feriado (Pago)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($feriados as $row) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['idDiasFeriados']); ?></td>
                            <td><?php echo htmlspecialchars($row['fecha']); ?></td>
                            <td><?php echo htmlspecialchars($row['descripcion']); ?></td>
                            <td><?php echo htmlspecialchars($row['tipoFeriado']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</main>