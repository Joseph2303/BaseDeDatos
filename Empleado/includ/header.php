<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>HCR</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <!-- BOOTSTRAP 4 -->
  <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
  <!-- FONT AWESOME -->
  <link rel="icon" type="image/x-icon" href="img/letra-h.png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <script>
    function changeView(view) {
      var container = document.getElementById('view-container');
      var url = 'viewsEmpleados/' + view + '.php';
      fetch(url)
        .then(response => response.text())
        .then(data => {
          container.innerHTML = data;
        })
        .catch(error => {
          console.log('Error:', error);
        });
    }

    function changeView2(view) {
      var container = document.getElementById('view-container');
      var url = 'viewsEncargados/' + view + '.php';
      fetch(url)
        .then(response => response.text())
        .then(data => {
          container.innerHTML = data;
        })
        .catch(error => {
          console.log('Error:', error);
        });
    }
    window.addEventListener('load', function() {
      var preloader = document.querySelector('.preloader');

      preloader.classList.add('hide');

      setTimeout(function() {
        preloader.style.display = 'none';
      }, 600);
    });
  </script>
  <style>
    .container {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .barra {
      background-color: rgba(255, 255, 255, 0.9);
      border-radius: 15px;
      padding: 15px;
      margin: 15px 0;
      margin-top: 1%;
      margin-left: 1%;
      margin-right: 1%;
      margin-bottom: 1%;
      position: fixed;
      left: 0;
      top: 0;
      height: 95%;
      width: 315px;
      border-right: 1px solid #ccc;
      padding: 20px;
    }

    /*asasasas*/
    .barra {
      max-height: 900px;
      overflow-y: auto;
      background-color: #f8f8f8;
      /* Cambia el color de fondo según tu preferencia */
      border: 1px solid #ccc;
      /* Agrega un borde al contenedor si lo deseas */
      padding: 10px;
      /* Espaciado interno dentro del contenedor */
    }


    /*asasasas*/
    .container {
      margin-bottom: 20px;
    }

    .nav-item {
      background-color: rgba(60, 241, 74, 0.200);
      border-radius: 10px;
      padding: 5px 10px;
      margin: 5px 0;
      width: 75%;
      display: inline-block;
      text-decoration: none;
      color: white;
      margin-right: 10px;
      font-size: 20px;
      color: #707070;
    }

    .nav-item:hover {
      background-color: rgba(167, 241, 101);
    }

    .nav-item1 {
      background-color: rgba(0, 203, 255, 0.200);
      border-radius: 10px;
      padding: 5px 10px;
      margin: 5px 0;
      width: 110%;
      display: inline-block;
      text-decoration: none;
      color: white;
      margin-right: 10px;
      font-size: 20px;
      color: #707070;
    }

    .nav-item1:hover {
      background-color: rgba(0, 203, 255);
    }

    .preloader {
      position: fixed;
      left: 0;
      top: 0;
      right: 0;
      bottom: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: white;
      /* o cualquier otro color de fondo que prefieras */
      z-index: 9999;
      /* para que aparezca por encima de todo lo demás */
    }
  </style>
</head>

<body style="background-image: url(img/aeropuerto-daniel-oduber-liberia.jpg);  background-repeat:  no-repeat;  background-size: cover ; font-family: 'century Gothic', sans-serif ;">
  <div class="preloader">
    <img src="img/icons8-reloj-arena-abajo.gif">
  </div>
  <div class="barra">
    <img src="img/siglas_coriport.png" style=" width: 230px; height: 110px;">
    <div class="container">
    </div>
    <ul class="nav">
      <?php
      if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
        echo '
        <div class="side-box">
          <div class="container1">
          <h3 class="text-primary">Perfil de Empleado</h3>
          </div>
          <li class="nav-item">
              <a class="nav-link bi bi-cup-straw icon" href="#" onclick="changeView(\'diasFeriados\')"> Días Feriados</a>
            </li>
            <li class="nav-item">
              <a class="nav-link bi bi-calendar icon" href="#" onclick="changeView(\'horario\')"> Resgitrar Asistencia</a>
            </li>
            <li class="nav-item">
              <a class="nav-link bi bi-clipboard-check icon" href="#" onclick="changeView(\'justificacionAusencia\')"> Justificación de Ausencias</a>
            </li>
            <li class="nav-item">
            <a class="nav-link bi bi-clipboard-check icon" href="#" onclick="changeView(\'justificacionTardia\')"> Justificación de Tardias</a>
          </li>
            <li class="nav-item">
              <a class="nav-link bi bi-hourglass-split icon" href="#" onclick="changeView(\'horasExtra\')"> Horas Extra</a>
            </li>
            <li class="nav-item">
              <a class="nav-link bi bi-sun-fill icon" href="#" onclick="changeView(\'solicitudVacaciones\')"> Solicitud de Vacaciones</a>
            </li>
            <br>
            <br>
            <br>
            <br>
            <li class="nav-item">
              <a class="nav-link bi bi-box-arrow-right icon" href="viewsEmpleados/logoutEmpleado.php"  onclick=""> Cerrar sesión</a>
            </li>
            </div>
          ';
      } elseif (isset($_SESSION['logged_in_admin']) && $_SESSION['logged_in_admin'] === true) {
        echo '
        <div class="container1">
         <center><h3 style="color: black; class="text-success">Perfil de Encargado</h3></center>
          </div>
            <li class="nav-item1">
              <a class="nav-link bi bi-calendar-plus" href="#" onclick="changeView2(\'crearFeriado\')" style="color: black;">  Crear Días Feriados</a>
            </li>
            <li class="nav-item1">
              <a class="nav-link bi bi-person-plus" href="#" onclick="changeView2(\'crearEmpleado\')" style="color: black;">  Crear Empleado</a>
            </li>
            <li class="nav-item1">
              <a class="nav-link bi bi-sticky icon" href="#" onclick="changeView2(\'aprovacionJustificacion\')" style="color: black;">  Aprobación de Ausencias</a>
            </li>
            <li class="nav-item1">
              <a class="nav-link bi bi-airplane bi bi-calendar-check" href="#" onclick="changeView2(\'aprovacionVacaciones\')" style="color: black;">  Aprobación de Vacaciones</a>
            </li>
            <li class="nav-item1">
              <a class="nav-link bi bi-clock-history" href="#" onclick="changeView2(\'registroTardia\')" style="color: black;">  Registro de Tardía</a>
            </li>
            <li class="nav-item1">
              <a class="nav-link bi bi-clock-history" href="#" onclick="changeView2(\'registroAusentismo\')" style="color: black;">  Registro de Ausencia</a>
            </li>
            <li class="nav-item1">
              <a class="nav-link bi bi-person-lines-fill" href="#" onclick="changeView2(\'editUser\')" style="color: black;">  Modificar Usuario</a>
            </li>
            <li class="nav-item1">
              <a class="nav-link bi  bi-sticky icon" href="#" onclick="changeView2(\'justificacionAusencia\')" style="color: black;">  Justificación de Ausencia</a>
            </li>
            <li class="nav-item1">
              <a class="nav-link bi bi-clipboard-check-fill" href="#" onclick="changeView2(\'puesto\')" style="color: black;">  Puestos de trabajo</a>
            </li>
            <li class="nav-item1">
              <a class="nav-link bi bi-check-circle icon" href="#" onclick="changeView2(\'marca\')" style="color: black;">  Marcas </a>
            </li>
            <li class="nav-item1">
              <a class="nav-link bi bi-hourglass-split icon" href="#" onclick="changeView2(\'HorasEncargado\')" style="color: black;">  Horas Extra</a>
            </li>
            <br>
            <br>
            <br>
            <br>
            <li class="nav-item1">
              <a class="nav-link bi bi-box-arrow-right" href="viewsEncargados/logoutAdmin.php" onclick="" style="color: black;">  Cerrar sesión</a>
            </li>
          ';
      } else {
        unset($_SESSION['logged_in_admin']);
        unset($_SESSION['logged_in']);
        unset($_SESSION['authentication']);
        echo '
          <li class="nav-item">
            <a class="nav-link bi bi-door-open-fill" href="userLogin.php">Iniciar Sesión</a>
          </li>
        ';
      }
      ?>
    </ul>
  </div>

  <?php
  if (isset($_SESSION['message'])) {
    echo '<div id="success-message" class="alert alert-success">' . $_SESSION['message'] . '</div>';
    unset($_SESSION['message']);
  } elseif (isset($_SESSION['val_close']) && $_SESSION['val_close'] === true) {
    echo '<div id="success-message" class="alert alert-info">' . $_SESSION['message_close'] . '</div>';
    unset($_SESSION['message_close']);
    $_SESSION['val_close'] = false;
  } elseif (isset($_SESSION['message_danger'])) {
    echo '<div id="success-message" class="alert alert-danger">' . $_SESSION['message_danger'] . '</div>';
    unset($_SESSION['message_danger']);
  }
  ?>

  <script>
    setTimeout(function() {
      document.getElementById('success-message').style.display = 'none';
    }, 95000);
  </script>

  <div id="view-container">
    <br>
    <?php
    include("db.php");

    if (isset($_SESSION['horario_saved']) && $_SESSION['horario_saved'] === true) {
      echo '<script>changeView("horario");</script>';
      unset($_SESSION['horario_saved']);
    } elseif (isset($_SESSION['horario_edit']) && $_SESSION['horario_edit'] === true) {
      echo '<script>changeView("horario");</script>';
      unset($_SESSION['horario_edit']);
    } elseif (isset($_SESSION['justificaion_message']) && $_SESSION['justificaion_message'] === true) {
      echo '<script>changeView("justificacionAusencia");</script>';
      unset($_SESSION['justificaion_message']);
    } elseif (isset($_SESSION['solicitud_empleado']) && $_SESSION['solicitud_empleado'] === true) {
      echo '<script>changeView("solicitudVacaciones");</script>';
      unset($_SESSION['solicitud_empleado']);
    } elseif (isset($_SESSION['empleado_message']) && $_SESSION['empleado_message'] === true) {
      echo '<script>changeView2("crearEmpleado");</script>';
      unset($_SESSION['empleado_message']);
    } elseif (isset($_SESSION['feriado_message']) && $_SESSION['feriado_message'] === true) {
      echo '<script>changeView2("crearFeriado");</script>';
      unset($_SESSION['feriado_message']);
    } elseif (isset($_SESSION['justificaion_message2']) && $_SESSION['justificaion_message2'] === true) {
      echo '<script>changeView2("aprovacionjustificacion");</script>';
      unset($_SESSION['justificaion_message2']);
    } elseif (isset($_SESSION['usuario_message']) && $_SESSION['usuario_message'] === true) {
      echo '<script>changeView2("editUser");</script>';
      unset($_SESSION['usuario_message']);
    } elseif (isset($_SESSION['encargado_solicitud']) && $_SESSION['encargado_solicitud'] === true) {
      echo '<script>changeView2("aprovacionVacaciones");</script>';
      unset($_SESSION['encargado_solicitud']);
    } elseif (isset($_SESSION['puesto_message']) && $_SESSION['puesto_message'] === true) {
      echo '<script>changeView2("puesto");</script>';
      unset($_SESSION['puesto_message']);
    } else {
      echo '

      <center>
      <img src="img/CoriportIdentifierRGB-1581026144-removebg-preview.png" style=" width: 510px; height: 220px; 
      margin-top: 13%;
      margin-bottom: 1%;
      ">
      </center>
      ';
    }
    ?>
  </div>
</body>
<script>
  function confirmarEliminacion() {
    return confirm('¿Estás seguro de que deseas eliminar?');
  }
</script>

<script>
  function mostrarFormulario(checkbox) {
    var formulario = document.getElementById("formulario");
    if (checkbox.checked) {
      formulario.style.display = "block";

      var fechaActual = new Date();
      var dia = fechaActual.getDate();
      var mes = fechaActual.getMonth() + 1;
      var año = fechaActual.getFullYear();

      var fila = checkbox.parentNode.parentNode;
      var idJustificacionAusencia = fila.getAttribute("data-id");
      var fechaSolicitud = fila.children[1].textContent;
      var fechaAusencia = fila.children[2].textContent;
      var archivos = fila.children[3].textContent;
      var justificacion = fila.children[4].textContent;

      var fechaFormateada = año + '-' + (mes < 10 ? '0' + mes : mes) + '-' + (dia < 10 ? '0' + dia : dia);

      document.getElementById("idJustificacionAusencia").value = idJustificacionAusencia;
      document.getElementById("fechaSolicitud").value = fechaFormateada;
      document.getElementById("fechaAusencia").value = fechaAusencia;
      document.getElementById("archivos").value = archivos;
      document.getElementById("justificacion").value = justificacion;

    } else {
      formulario.style.display = "none";
    }
  }
</script>


<script>
  document.getElementById('foto').addEventListener('change', function(e) {
    var reader = new FileReader();
    reader.onload = function(e) {
      document.getElementById('imagen').src = e.target.result;
      document.getElementById('imagen').style.display = 'block';
    };
    reader.readAsDataURL(this.files[0]);
  });










  function mostrarPopup() {
    document.getElementById('popup').style.display = 'flex';
}

function cerrarPopup() {
    document.getElementById('popup').style.display = 'none';
}

function eliminarFila(btn) {
    var row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
}

function actualizarFila(btn) {
    var row = btn.parentNode.parentNode;
    var cells = row.getElementsByTagName("td");

    var fechaSolicitud = cells[0].textContent;
    var fechaAusencia = cells[1].textContent;
    var archivos = cells[2].textContent;
    var justificacion = cells[3].textContent;

    var formHTML = `
        <td><input type="date" value="${fechaSolicitud}"></td>
        <td><input type="date" value="${fechaAusencia}"></td>
        <td><input type="text" value="${archivos}"></td>
        <td><input type="text" value="${justificacion}"></td>
        <td>
            <button onclick="guardarCambios(this)">Guardar</button>
            <br><br>
            <button onclick="cancelarActualizacion(this)">Cancelar</button>
        </td>
    `;

    row.innerHTML = formHTML;
}


function guardarCambios(btn) {
    var row = btn.parentNode.parentNode;
    var cells = row.getElementsByTagName("td");
    
    var fechaSolicitud = cells[0].querySelector("input").value;
    var fechaAusencia = cells[1].querySelector("input").value;
    var archivos = cells[2].querySelector("input").value;
    var justificacion = cells[3].querySelector("input").value;
    
    cells[0].innerHTML = fechaSolicitud;
    cells[1].innerHTML = fechaAusencia;
    cells[2].innerHTML = archivos;
    cells[3].innerHTML = justificacion;
    
    var accionesCell = row.querySelector("td:last-child");
    accionesCell.innerHTML = '<button onclick="eliminarFila(this)">Eliminar</button> ' +
                             '<button onclick="actualizarFila(this)">Actualizar</button>';
}

</script>

</html>