<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Marcas</title>
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <!-- BOOTSTRAP 4 -->
  <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
  <!-- FONT AWESOME -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <style>
    .custom-label {
      font-weight: bold;
    }

    .custom-submit {
      margin-top: 20px;
    }

  </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $('input[name="idMarca"]').on('input', function() {
        var parametroBuscar = $(this).val();

        $.ajax({
          type: 'POST',
          url: 'tabla.php',  // Cambia esto al archivo que maneja la búsqueda
          data: { buscar: 'Buscar', idMarca: parametroBuscar },
          success: function(data) {
            $('#resultados').html(data);
          }
        });
      });
    });
  </script>
</head>
<body style="background-image: url(img/fondo-degradado-tonos-verdes_23-2148387744.avif); background-repeat:  no-repeat; background-size: cover;">
  <div class="container p-4">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">Buscar Marcas</div>
          <div class="card-body">
            <form method="POST" action="">
              <div class="form-group row">
                <label for="idMarca" class="col-md-4 col-form-label custom-label">Marca</label>
                <div class="col-md-8">
                  <input type="text" name="idMarca" class="form-control" placeholder="Digite la descripción de la marca" required>
                </div>
              </div>
              <div class="form-group row custom-submit">
                <div class="col-md-4 offset-md-4">
                  <button type="submit" name="buscarPorEmpleado" class="btn btn-primary">Buscar</button>
                </div>
                <div class="col-md-4">
                  <a class="btn btn-success" href="../index.php">Volver</a>
                </div>
              </div>
            </form>

              <div id="resultados">

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
