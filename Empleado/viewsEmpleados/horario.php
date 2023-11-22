<?php include("../db.php"); 
if (isset($_SESSION['logged_in_admin']) && $_SESSION['logged_in_admin'] === true) {
  $_SESSION['cont'] = true;
}
include('../includ/proted.php');

?>
<style>
  .container {
    margin-left: 22%;
    margin-right: 22%;
    margin-top: 1%;
  }

  .alert {
    margin-bottom: 10px;
  }


  table {
    background-color: #fff;
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
    background-color: #93D78C;
    color: #fff;
  }

  tr:nth-child(even) {
    background-color: #f2f2f2;
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
<main class="container p-4 col-9" style="background-color: rgba(255, 255, 255, 0.9);">
  <h1 class="text-center">Registre su Asistencia</h1>
  <br>
  <div class="row">
    <div class="col-md-6">
      <div class="card card-body">
        <form action="horario/save.php" method="POST">
          <h3>Marcar entrada</h3>
          <div class="form-group">
   
          </div>
          <input class="btn btn-success btn-block" type="submit" name="save" value="Marcar Entrada">
        </form>
        <!-- MESSAGES FOR MARCA ENTRADA -->
        <?php if (isset($_SESSION['message_entrada'])) { ?>
          <div class="text-center mt-3">
            <div class="alert alert-<?= htmlspecialchars($_SESSION['message_type_entrada']) ?> alert-dismissible fade show" role="alert">
              <?= htmlspecialchars($_SESSION['message_entrada']) ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
          <?php unset($_SESSION['message_entrada']);
        } ?>
      </div>
    </div>
    <div class="col-md-5">
      <div class="card card-body">
        <form action="horario/edit.php" method="POST">
          <h3>Marcar salida</h3>
          <div class="form-group">
          </div>
          <input class="btn btn-info btn-block" type="submit" name="update" value="Marcar Salida">
        </form>
        <!-- MESSAGES FOR MARCA SALIDA -->
        <?php if (isset($_SESSION['message_salida'])) { ?>
          <div class="text-center mt-3">
            <div class="alert alert-<?= htmlspecialchars($_SESSION['message_type_salida']) ?> alert-dismissible fade show" role="alert">
              <?= htmlspecialchars($_SESSION['message_salida']) ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          </div>
          <?php unset($_SESSION['message_salida']);
        } ?>
      </div>
    </div>
  </div>
  <br>
  <br>
  <br>
  <br>

</main>
