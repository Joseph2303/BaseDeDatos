<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puesto</title>
    
  <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
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
      $('input[name="idPuesto"]').on('input', function() {
        var parametroBuscar = $(this).val();

        $.ajax({
          type: 'POST',
          url: 'puesto.php',  
          data: { buscar: 'Buscar', idPuesto: parametroBuscar },
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
          <div class="card-header">Buscar Puesto</div>
          <div class="card-body">
            <form method="POST" action="">
              <div class="form-group row">
                <label for="idPuesto" class="col-md-4 col-form-label custom-label">Puesto</label>
                <div class="col-md-8">
                  <input type="text" name="idPuesto" class="form-control" placeholder="Digite el puesto" required>
                </div>
              </div>
              <div class="form-group row custom-submit">
                <div class="col-md-4 offset-md-4">
                  <button type="submit" name="buscarPorPuesto" class="btn btn-primary">Buscar</button>
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