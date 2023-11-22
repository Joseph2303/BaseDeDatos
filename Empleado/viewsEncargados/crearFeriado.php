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

<main class="container p-4 col-8">
    <h1 class="text-center">Días Feriados</h1>
    <br>
    <div class="row">
        <div class="col-4">
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
            <div>
                <input type="text" id="buscar" oninput="filtrar()" placeholder="Buscar día feriado...">
            </div>
            <br>
            <table id="tabla" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID Día Feriado</th>
                        <th>Fecha</th>
                        <th>Descripción</th>
                        <th>Tipo de Feriado (Pago)</th>
                        <th>Acción</th>
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
                    <tr>
                        <td>Fecha 1</td>
                        <td>Fecha 2</td>
                        <td>Archivo 1</td>
                        <td>Justificación 1</td>
                        <td>
                            <input type="checkbox" onchange="mostrarbotones(this)">
                        </td>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div id="modal" style="
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
            ">
                <div style="
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                
                ">
                    <span style="
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 20px;
    cursor: pointer;
                    " onclick="cerrarModal()">&times;</span>
                    <form id="formularioModificar" action="diasFeriados/save.php" method="POST" style="display: none;">
                       
                        <input type="submit" class="btn btn-info btn-block" name="save" value="Guardar">
                    </form>
                </div>
            </div>
            
            <div class="botones" style="display: none;">
                <button class="btn btn-primary btn-sm" onclick="mostrarFormulario(this)">Modificar</button>
                <button class="btn btn-danger btn-sm" onclick="eliminar()">Eliminar</button>
            </div>
        </div>
    </div>
</main>