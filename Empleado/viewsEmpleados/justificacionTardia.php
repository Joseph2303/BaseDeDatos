<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("../db.php");
if (isset($_SESSION['logged_in_admin']) && $_SESSION['logged_in_admin'] === true) {
    $_SESSION['cont'] = true;
}
include('../includ/proted.php');

if (isset($_SESSION['empleadoData']) && isset($_SESSION['empleadoData']['idEmpleado'])) {

    function consultarJustificacionTardia()
    {
        $idEmpleado = $_SESSION['empleadoData']['idEmpleado'];
        $query = "SELECT jt.[idJustificacionTardia]
    ,jt.[fecha] AS justificacionFecha
    ,jt.[documento]
    ,jt.[justiTardia]
    ,jt.[revision]
    ,rt.[idRegistroTardia]
    ,rt.[fecha] AS registroFecha
    ,rt.[tipoTardia]
    ,rt.[CantMinutos]
    ,rt.[idHorario]
    ,rt.[idEmpleado]
    ,rt.[idMarca]
    FROM [proyecto_bd].[dbo].[justificacionTardia] AS jt
    INNER JOIN [proyecto_bd].[dbo].[registroTardia] AS rt ON jt.[idRegistroTardia] = rt.[idRegistroTardia]
    WHERE rt.[idEmpleado] = $idEmpleado";


        try {
            $stmt = $GLOBALS['conn']->query($query);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $rows;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    $justificacionTardia = consultarJustificacionTardia();
}
?>


<!DOCTYPE html>
<html>

<head>
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
            border-collapse: collapse;
            width: 100%;
            max-width: 950px;

        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #93D78C;
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

    <style>
        #formulario {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f8f8;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
            color: #333;
            font-size: 14px;
            margin-bottom: 6px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>

</head>

<body>
    <main class="container p-4 col-9" style="background-color: rgba(255, 255, 255, 0.9)">

        <div class="justificacion">
            <h1>Justificación de Tardía</h1>
        </div>
        <br>
        <div>
            <input type="text" id="buscar" oninput="filtrar()" placeholder="Buscar justificación...">
        </div>
        <br>
        <table id="tabla">
            </thead>
            <tr>
                <th>ID de Justificación Tardía</th>
                <th>Fecha</th>
                <th>Documento</th>
                <th>Jutificación</th>
                <th>Revisión</th>
                <th>Acción</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($justificacionTardia as $row) { ?>
                    <tr>
                    <tr data-id="<?php echo htmlspecialchars($row['idJustificacionTardia']); ?>">
                        <td><?php echo htmlspecialchars($row['idJustificacionTardia']); ?></td>
                        <td><?php echo htmlspecialchars(date('Y-m-d', strtotime($row['justificacionFecha']))); ?></td>
                        <td><?php echo htmlspecialchars($row['documento']); ?></td>
                        <td><?php echo htmlspecialchars($row['justiTardia']); ?></td>
                        <td><?php echo htmlspecialchars($row['revision']); ?></td>
                        <td>
                            <a href="registroTardia/edit.php?idJustificacionTardia=<?php echo htmlspecialchars($row['idJustificacionTardia']); ?>" class="btn btn-info">
                                <i class="fas fa-marker"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>

        </table>

        <form id="formulario" style="display: none;">

            <label for="idJustificacionTardia">ID de la justificación tardía:</label><br>
            <input type="text" id="idJustificacionTardia" name="idJustificacionTardia" readonly><br><br>

            <label for="fecha">Fecha:</label><br>
            <input type="date" id="fecha" name="fecha" readonly><br><br>

            <label for="documento">Documento:</label><br>
            <input type="file" id="documento" name="documento"><br><br>

            <label for="justiTardia">Justificación Tardía:</label><br>
            <input type="text" id="justiTardia" name="justiTardia"><br><br>

            <label for="revision">Revisión:</label><br>
            <input type="text" id="revision" name="revision" value="pendiente" readonly><br><br>

            <input type="submit" value="Enviar">

        </form>

    </main>

</body>

</html>