<?php
session_start();

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mundo_deporte";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$json = file_get_contents('php://input');
$data = json_decode($json, true);

$itemTitle = $item['itemTitle'];
$itemPrice = $item['itemPrice'];
$elementQuantity = $item['elementQuantity'];
$total = $item['total'];
$fecha_hora = date('Y-m-d H:i:s');
$id = uniqid('', true);
$id = hash('sha256', $id);
        
$datos_a_insertar = "INSERT INTO datos (`ID`, `Producto`, `Precio Unitario`, `Cantidad`, `Precio Total`, `Fecha y hora`) 
VALUES ('[$id]', '[$itemTitle]', '[$itemPrice]', '[$elementQuantity]', '[$total]', '[$fecha_hora]')";

$Insertar= mysqli_query($conn, $datos_a_insertar)


mysqli_close($conn);
?>