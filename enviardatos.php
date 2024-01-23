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

// Rest of your code...
$id_profesor = $_POST['select_profesor'];
$id_sala = $_POST['select_sala'];
$id_carro = $_POST['select_carrito'];
$horaTermino = $_COOKIE["horaTermino"];
$horaInicio = $_COOKIE["horaInicio"];

// Convert date and time strings to DateTime objects
$dateTimeInicio = new DateTime($horaInicio);
$dateTimeTermino = new DateTime($horaTermino);

// Format the DateTime objects and convert them to strings
$formattedHoraInicio = $dateTimeInicio->format('Y-m-d H:i:s');
$formattedHoraTermino = $dateTimeTermino->format('Y-m-d H:i:s');

$insert = "INSERT INTO reserva (hora_inicio, hora_termino, profesor_id_profesor, sala_id_sala, carro_id_carro) 
           VALUES ('".$formattedHoraInicio."', '".$formattedHoraTermino."', $id_profesor, $id_sala, $id_carro);";

if (mysqli_query($conn, $insert)) {
    $_SESSION['message'] = 'Registro guardado exitosamente';
    $_SESSION['message_type'] = 'success';
    header('Location: index.php');
} else {
    echo "El registro no se pudo guardar: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
