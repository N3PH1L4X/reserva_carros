<?php

include('conexion.php')

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./reserva.css">
</head>

<style>
    /* Estilos CSS para el calendario */
    /* ... */
    /* Estilos CSS para el calendario */
    .calendar-container {
      width: 100%;
      max-width: 600px;
      margin: 0 auto;
    }

    .calendar {
      display: grid;
      grid-template-columns: 80px repeat(6, 1fr);
      grid-gap: 1px;
      border: 1px solid #ccc;
    }

    .calendar-header,
    .calendar-time,
    .calendar-square {
      background: #f0f0f0;
      padding: 10px;
      text-align: center;
      font-weight: bold;
    }

    .calendar-header {
      cursor: pointer;
    }

    .calendar-header:hover {
      background: #e0e0e0;
    }

    .calendar-time {
      cursor: pointer;
    }

    .calendar-square {
      border: 1px solid black;
    }

    .calendar-square.selected {
      background-color: #007bff;
      color: #fff;
    }

    .oneClick {
      cursor: pointer;
    }

    /* Estilos CSS para la ventana emergente */
    .popup-container {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0, 0, 0, 0.5);
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 999;
      display: none;
    }

    .popup {
      background-color: #fff;
      padding: 20px;
      max-width: 600px;
      width: 100%;
      max-height: 80vh;
      overflow-y: auto;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }
  </style>
<body>

  <div class="formbold-main-wrapper">
      <div class="formbold-form-wrapper">

        <form action="./enviardatos.php" method="POST" enctype="multipart/form-data">

            <div class="formbold-input-flex">

              <div>
                  <select id="select_profesor" name="select_profesor" class="form-control" >
                    <option value="">Seleccione:</option>
                    <?php
                    $query = $db->prepare("SELECT * FROM profesor");
                    $query->execute();
                    $data = $query->fetchAll();

                    foreach ($data as $valores):
                      echo '<option value="'.$valores["id_profesor"].'">'.$valores["nombre_profesor"]." ".$valores["apellido_profesor"].'</option>';
                    endforeach;
                    ?>
                  </select>
                  <label for="firstname" class="formbold-form-label">Nombre profesor</label>
              </div>

              <div>
                  <select id="select_escuela" name="select_escuela" class="form-control" >
                    <option value="">Seleccione:</option>
                    <?php
                    $query = $db->prepare("SELECT * FROM escuela");
                    $query->execute();
                    $data = $query->fetchAll();

                    foreach ($data as $valores):
                      echo '<option value="'.$valores["id_escuela"].'">'.$valores["nombre_escuela"].'</option>';
                    endforeach;
                    ?>
                  </select>
                  <label for="firstname" class="formbold-form-label">Escuela</label>
              </div>

            </div>

            <div class="formbold-input-flex">

              <div>
                  <select id="select_carrito" name="select_carrito" class="form-control" >
                    <option value="">Seleccione:</option>
                    <?php
                    $query = $db->prepare("SELECT * FROM carro");
                    $query->execute();
                    $data = $query->fetchAll();

                    foreach ($data as $valores):
                      echo '<option value="'.$valores["id_carro"].'"> Carro #'.$valores["id_carro"]." (".$valores["cant_comp_carro"].' computadores)</option>';
                    endforeach;
                    ?>
                  </select>
                  <label for="firstname" class="formbold-form-label">Carrito a reservar</label>

              </div>

              <div>
                  <select id="select_sala" name="select_sala" class="form-control" >
                    <option value="">Seleccione:</option>
                    <?php
                    $query = $db->prepare("SELECT * FROM sala");
                    $query->execute();
                    $data = $query->fetchAll();

                    foreach ($data as $valores):
                      echo '<option value="'.$valores["id_sala"].'">'.$valores["numero_sala"]." (Piso ".$valores["piso_sala"].')</option>';
                    endforeach;
                    ?>
                    <option value="99999999">Otra</option>
                  </select>
                  <label for="firstname" class="formbold-form-label">En la sala numero</label>
              </div>

              <div>
                <input type="text" id="opcional_num_sala" name="opcional_num_sala">
                <label for="opcional_num_sala" class="formbold-form-label">En caso de seleccionar otra sala, indique el numero de sala:</label>
              </div>
            </div>


            
            <input onclick="openPopup()" class="favorite styled" type="button" value="Abrir calendario">
            <div class="popup-container" id="popupContainer">
              <div class="popup">
                <input onclick="closePopup()" class="favorite styled" type="button" value="Cerrar calendario">
                <div class="calendar-container">
                  <div class="calendar-container">
                    <div class="calendar">
                      <div class="calendar-header"></div>
                      <div class="calendar-header">Lunes</div>
                      <div class="calendar-header">Martes</div>
                      <div class="calendar-header">Miércoles</div>
                      <div class="calendar-header">Jueves</div>
                      <div class="calendar-header">Viernes</div>
                      <div class="calendar-header">Sábado</div>
                
                      <div class="calendar-time">
                        <div>8:30</div>
                        <div>A</div>
                        <div>9:30</div>
                      </div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '8:30', '9:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '8:30', '9:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '8:30', '9:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '8:30', '9:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '8:30', '9:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '8:30', '9:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                
                      <div class="calendar-time">
                        <div>9:30</div>
                        <div>A</div>
                        <div>10:30</div>
                      </div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '9:30', '10:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '9:30', '10:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '9:30', '10:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '9:30', '10:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '9:30', '10:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '9:30', '10:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                
                      <div class="calendar-time">
                        <div>10:30</div>
                        <div>A</div>
                        <div>11:30</div>
                      </div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '10:30', '11:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '10:30', '11:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '10:30', '11:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '10:30', '11:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '10:30', '11:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '10:30', '11:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                
                      <div class="calendar-time">
                        <div>11:30</div>
                        <div>A</div>
                        <div>12:30</div>
                      </div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '11:30', '12:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '11:30', '12:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '11:30', '12:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '11:30', '12:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '11:30', '12:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '11:30', '12:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                
                      <div class="calendar-time">
                        <div>12:30</div>
                        <div>A</div>
                        <div>13:30</div>
                      </div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '12:30', '13:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '12:30', '13:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '12:30', '13:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '12:30', '13:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '12:30', '13:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '12:30', '13:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                
                      <div class="calendar-time">
                        <div>13:30</div>
                        <div>A</div>
                        <div>14:30</div>
                      </div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '13:30', '14:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '13:30', '14:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '13:30', '14:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '13:30', '14:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '13:30', '14:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '13:30', '14:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                
                      <div class="calendar-time">
                        <div>14:30</div>
                        <div>A</div>
                        <div>15:30</div>
                      </div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '14:30', '15:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '14:30', '15:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '14:30', '15:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '14:30', '15:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '14:30', '15:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                      <div class="calendar-square oneClick" onclick="var horario = selectDateTime(0, '14:30', '15:30', this); var dia = horario[0]; var horaInicio = horario[1]; var horaTermino = horario[2];"></div>
                
                    </div>
                  </div>
                
                  <script>
                    // Función para seleccionar la fecha y hora
                    function selectDateTime(dayIndex, startTime, endTime, squareElement) {

                      const date = new Date();
                      let currentDay= String(date.getDate()).padStart(2, '0');
                      let currentMonth = String(date.getMonth()+1).padStart(2,"0");
                      let currentYear = date.getFullYear();
                      // we will display the date as DD-MM-YYYY 
                      let currentDate = `${currentDay}-${currentMonth}-${currentYear}`;

                      // Desmarcar el cuadro previamente seleccionado
                      var previousSelectedSquare = document.querySelector('.calendar-square.selected');
                      if (previousSelectedSquare) {
                        previousSelectedSquare.classList.remove('selected');
                      }
                
                      // Marcar el cuadro seleccionado
                      squareElement.classList.add('selected');
                
                      // Actualizar los detalles de la reserva seleccionada
                      var dayName = getDayName(dayIndex);
                      console.log('Día seleccionado:', dayName);
                      console.log('Hora de inicio:', startTime);
                      console.log('Hora de fin:', endTime);

                      document.cookie = "dia=".concat(dayName);
                      document.cookie = "horaInicio=".concat(currentDate).concat(' ').concat(startTime).concat(':00');
                      document.cookie = "horaTermino=".concat(currentDate).concat(' ').concat(endTime).concat(':00');

                    }
                
                    // Obtener el nombre del día según el índice
                    function getDayName(dayIndex) {
                      var days = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
                      return days[dayIndex];
                    }
                  </script>
                </div>
              </div>
            </div>

            <script>

              const horario = selectDateTime()

              function openPopup() {
                var popupContainer = document.getElementById('popupContainer');
                popupContainer.style.display = 'flex';
              }

              function closePopup() {
                var popupContainer = document.getElementById('popupContainer');
                popupContainer.style.display = 'none';
              }

              function getCarrito() {
                var selectElement = document.getElementById("select_carrito");
                var selectedValue = selectElement.value;
                document.cookie = "carrito=".concat(selectedValue);
              }

              function getProfesor() {
                var selectElement = document.getElementById("select_profesor");
                var selectedValue = selectElement.value;
                document.cookie = "profesor=".concat(selectedValue);
              }

              function getEscuela() {
                var selectElement = document.getElementById("select_escuela");
                var selectedValue = selectElement.value;
                document.cookie = "escuela=".concat(selectedValue);
              }

              function getSala() {
                var selectElement = document.getElementById("select_sala");
                var selectedValue = selectElement.value;

                var selectElement = document.getElementById("opcional_num_sala");
                var selectedValue2 = selectElement.value;

                if(selectedValue == 'n'){
                  document.cookie = "sala=".concat(selectedValue2);
                }else{
                  document.cookie = "sala=".concat(selectedValue);
                }
              }

              function getHoraInicial() {

              }

              function getHoraTermino() {
                
              }
            </script>

            <button class="formbold-btn">
                Enviar solicitud
            </button>

          </form>

                    

    </div>
  </div>


</body>
</html>

