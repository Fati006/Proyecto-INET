<?php
session_start();

// Verificar si el usuario es un administrador
if (!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
    header("Location: login.php");
    exit();
}

// Conexión a la base de datos
$servername = "localhost";
$user= "root";
$password = "";
$dbname = "mundo_deporte";

$conn = new mysqli($servername, $user, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consultar los pedidos
$sql = "SELECT * FROM `datos`";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Pedidos</title>
</head>
<body>
    <h2>Panel de Administración</h2>
    <h3>Pedidos Registrados</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Producto</th>
            <th>ID del Comprador</th>
            <th>Precio Unitario</th>
            <th>Cantidad</th>
            <th>Precio Total</th>
            <th>Fecha y Hora</th>
        </tr>
        <?php
            if ($result->num_rows > 0) {
                
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["ID"] . "</td>";
                    echo "<td>" . $row["Producto"] . "</td>";
                    echo "<td>" . $row["ID Comprador"] . "</td>";
                    echo "<td>" . $row["Precio Unitario"] . "</td>";
                    echo "<td>" . $row["Cantidad"] . "</td>";
                    echo "<td>" . $row["Precio Total"] . "</td>";
                    echo "<td>" . $row["Fecha y hora"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No hay pedidos registrados.</td></tr>";
            }
            $conn->close();
        ?>
    </table>
</body>
</html>