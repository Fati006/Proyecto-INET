<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos Registrados</title>


    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        button {
            padding: 5px 10px;
            color: white;
            background-color: red;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: rgb(192, 94, 132);
        }
    </style>
</head>
<body>
    <h1 style="text-align:center;">Pedidos Registrados</h1>

    <?php
    $direccion = "localhost";
    $usuario = "root";
    $password = "";
    $dbname = "mundo_deporte";

    // Conectar a la base de datos
    $conn = mysqli_connect($direccion, $usuario, $password, $dbname);

    if (!$conn) {
        die("Conexión fallida: " . mysqli_connect_error());
    }

    // Manejar la eliminación de un registro si se ha enviado una solicitud de eliminación
    if (isset($_POST['delete'])) {
        $id = $_POST['id'];

        $deleteQuery = "DELETE FROM `datos` WHERE ID = $id";
        $result = mysqli_query($conn, $deleteQuery);

        if ($result) {
            echo "<p style='color: green; text-align: center;'>Registro eliminado con éxito.</p>";
        } else {
            echo "<p style='color: red; text-align: center;'>Error al eliminar el registro: " . mysqli_error($conn) . "</p>";
        }
    }

    // Recuperar los datos de la base de datos
    $query = "SELECT * FROM `datos`";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Cantidad de Accidentes</th><th>Tipo de Accidente</th><th>Acción</th></tr>";
        
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['ID'] . "</td>";
            echo "<td>" . $row['Producto'] . "</td>";
            echo "<td>" . $row['ID Comprador'] . "</td>";
            echo "<td>" . $row['Precio unitario'] . "</td>";
            echo "<td>" . $row['Cantidad'] . "</td>";
            echo "<td>" . $row['Precio Total'] . "</td>";
            echo "<td>" . $row['Fecha y hora'] . "</td>";
            echo "<td>
                    <form method='POST' action=''>
                        <input type='hidden' name='id' value='" . $row['id'] . "'>
                        <button type='submit' name='delete'>Eliminar</button>
                    </form>
                  </td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p style='text-align: center;'>No hay pedidos registrados.</p>";
    }

    // Cerrar la conexión
    mysqli_close($conn);
    ?>
</body>
</html>
