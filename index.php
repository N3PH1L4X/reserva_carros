<?php

include('conexion.php');

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'reserva_carritos';

// Establish the database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check if the connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


?>


<!DOCTYPE html>
<html>
<head>
  <title>Reserva de carritos</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
    }

    h1 {
      color: #333;
    }

    .container {
      max-width: 800px;
      margin: 0 auto;
      background-color: #f5f5f5;
      padding: 20px;
      border-radius: 5px;
    }

    form {
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-bottom: 5px;
    }

    input[type="text"], select {
      width: 100%;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
      margin-bottom: 10px;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      border: none;
      padding: 10px 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin-bottom: 10px;
      cursor: pointer;
      border-radius: 5px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #4CAF50;
      color: white;
    }

    tr:hover {
      background-color: #f2f2f2;
    }
  </style>
</head>
<body>
  <div class="container">
    <form action="reserva.php">
      <input type="submit" value="Crear reservacion" />
    </form>
    <h1>Reservas actuales</h1>
    
    <table>
      <tr>
        <th>ID Reserva</th>
        <th>Hora de inicio</th>
        <th>Hora de termino</th>
        <th>Nombre Profesor</th>
        <th>Numero de sala</th>
        <th>Numero de carro</th>
      </tr>
      
      <?php
        // Include the database connection file
        include('conexion.php');

        // Write the SQL query to fetch data from the database
        $query = "SELECT * FROM reserva INNER JOIN profesor ON reserva.profesor_id_profesor=profesor.id_profesor INNER JOIN sala ON reserva.sala_id_sala=sala.id_sala INNER JOIN carro ON reserva.carro_id_carro=carro.id_carro ORDER BY hora_inicio ASC";

        // Execute the query
        $result = mysqli_query($conn, $query);

        // Check if any rows were returned
        if (mysqli_num_rows($result) > 0) {
          // Iterate over the result rows
          while ($row = mysqli_fetch_assoc($result)) {
            // Output the table row with the retrieved data
            echo "<tr>";
            echo "<td>" . $row['id_reserva'] . "</td>";
            echo "<td>" . $row['hora_inicio'] . "</td>";
            echo "<td>" . $row['hora_termino'] . "</td>";
            echo "<td>" . $row['nombre_profesor']. " " . $row['apellido_profesor'] . "</td>";
            echo "<td>" . $row['numero_sala'] . "</td>";
            echo "<td>" . $row['id_carro'] . "</td>";
            echo "</tr>";
          }
        } else {
          // No rows found
          echo "<tr><td colspan='6'>No reservations found</td></tr>";
        }

        // Close the database connection
        mysqli_close($conn);
      ?>
      
    </table>
  </div>
</body>
</html>