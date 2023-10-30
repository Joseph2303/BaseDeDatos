<?php
include("../db.php");

/*if(!isset($_SESSION['tipoUsuario'])){
  header('location: ../userLogin.php');
}else{
  if($_SESSION['tipoUsuario'] != 'empleado'){
      header('location: ../userLogin.php');
  }
}*/

?>

<html>
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
    max-width: 650px; /* Ajusta este valor según tus necesidades */
  }

  th,
  td {
    padding: 8px;
    text-align: left;
  }

  th {
    background-color: #333;
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
<body>
  <main class="container p-4 col-9" style="background-color: rgba(255, 255, 255, 0.9)">
    <div class="row">
      <div class="search-form col-10">
      <h1 class="text-center">Justificación de Ausencias</h1>
      </div>
      <div class="col-md-9"  style="padding-left: 2rem;">  
      <table class="table table-bordered" style="padding-left: 2rem;">
        <thead>
            <tr>
                <th>Fecha Ausente</th>
                <th>Accion</th>
            </tr>
        </thead> 
        <tbody>
            <tr>
              <td>29/10/2023</td> 
                <td>
                    <input type="checkbox" class="justify-checkbox">
                </td>
            </tr>
        </tbody>
    </table>
      </div><!--Cuando se selecciones un checkbox debe aparecer el boton de editar-->
    </div>
  </main>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var checkboxes = document.querySelectorAll('.justify-checkbox');
        checkboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                var form = this.parentElement.nextElementSibling.querySelector('.justify-form');
                form.style.display = this.checked ? 'block' : 'none';
            });
        });
    });
</script>
</html>
