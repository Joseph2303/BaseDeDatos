<?php
include("../db.php");

$idJustificacionTardia = '';
$fecha = '';
$justiTardia = '';
$revision = '';
$idRegistroTardia = '';

if (isset($_GET['idJustificacionTardia'])) {
    $idJustificacionTardia = $_GET['idJustificacionTardia'];
    $query = "SELECT * FROM justificacionTardia WHERE idJustificacionTardia = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $idJustificacionTardia, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $fecha = $row['fecha'];
        $justiTardia = $row['justiTardia'];
        $revision = $row['revision'];
        $idRegistroTardia = $row['idRegistroTardia'];
    }
}

if (isset($_POST['update'])) {
    $idJustificacionTardia = $_POST['idJustificacionTardia'];
    $fecha = $_POST['fecha'];
    $justiTardia = $_POST['justiTardia'];
    $revision = $_POST['revision'];
    $idRegistroTardia = $_POST['idRegistroTardia'];


    $query = "UPDATE justificacionTardia SET fecha = ?, justiTardia = ?, revision = ?, idRegistroTardia = ? WHERE idJustificacionTardia = ?";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(1, $fecha, PDO::PARAM_STR);
    $stmt->bindParam(2, $justiTardia, PDO::PARAM_STR);
    $stmt->bindParam(3, $revision, PDO::PARAM_STR);
    $stmt->bindParam(4, $idRegistroTardia, PDO::PARAM_INT);
    $stmt->bindParam(5, $idJustificacionTardia, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $_SESSION['message'] = 'Justificación Tardía actualizada exitosamente';
        $_SESSION['message_type'] = 'success';
        header('Location: ../index.php');
        exit();
    } else {
        // Error en la ejecución de la consulta
        $errorInfo = $stmt->errorInfo();
        $_SESSION['message'] = 'Error al actualizar la justificación tardía: ' . $errorInfo[2];
        $_SESSION['message_type'] = 'danger';
        header('Location: ../index.php');
        exit();
    }
}
?>

<head>
    <meta charset="UTF-8">
    <title>Justificación De Tardia</title>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <!-- BOOTSTRAP 4 -->
    <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
    <!-- FONT AWESOME -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>
<div class="container p-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar solicitud</div>
                <div class="card-body">
                    <form action="edit.php?idJustificacionTardia=<?php echo $_GET['idJustificacionTardia']; ?>" method="POST">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">ID de Justificacion de Tardia</label>
                            <div class="col-md-8">
                                <input name="idJustificacionTardia" type="text" class="form-control" value="<?php echo $idJustificacionTardia; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">Fecha</label>
                            <div class="col-md-8">
                                <input name="fecha" type="date" class="form-control" value="<?php echo $fecha; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">Documento</label>
                            <div class="col-md-8">
                                <input name="documento" type="file" class="form-control" value="<?php echo $documento; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">Justificación de Tardía</label>
                            <div class="col-md-8">
                                <input name="justiTardia" type="text" class="form-control" value="<?php echo $justiTardia; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">Revisión</label>
                            <div class="col-md-8">
                                <select name="revision" class="form-control">
                                    <option value="Pendiente" <?php echo ($revision === 'Pendiente') ? 'selected' : ''; ?>>Pendiente</option>
                                    <option value="Revisado" <?php echo ($revision === 'Revisado') ? 'selected' : ''; ?>>Revisado</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">ID Registro Tardía</label>
                            <div class="col-md-8">
                                <input name="idRegistroTardia" type="text" class="form-control" value="<?php echo $idRegistroTardia; ?>" readonly>
                            </div>
                        </div>
                        <button class="btn btn-success" name="update">Guardar</button>
                        <a class="btn btn-info" href="../index.php">Volver</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>