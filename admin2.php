<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="productos_style.css">
    <title>Carga de productos</title>
</head>
<body>
    <h1>Carga de productos</h1>
    <section>
        <!-- El formulario debe usar enctype="multipart/form-data" para manejar la carga de archivos -->
        <form action="" method="post" enctype="multipart/form-data">
            <label>Nombre del producto</label>
            <input type="text" name="Nombre_Producto" required>

            <br>

            <label>Precio $</label>
            <input type="number" name="Precio_Producto" required>

            <br>
            
            <label>Imagen del producto</label>
            <input type="file" name="Imagen_Producto" required>

            <br>

            <button type="submit">Enviar</button>
        </form>
    </section>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $direccion = "localhost";
    $usuario = "root";
    $contraseña = "";
    $dbname = "mundo_deporte";
    
    // Conexión a la base de datos
    $conn = mysqli_connect($direccion, $usuario, $contraseña, $dbname);

    if (!$conn) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    // Obtener datos del formulario
    $Nombre_Producto = mysqli_real_escape_string($conn, $_POST['Nombre_Producto']);
    $Precio_Producto = mysqli_real_escape_string($conn, $_POST['Precio_Producto']);

    // Manejo de la imagen subida
    if (isset($_FILES['Imagen_Producto']) && $_FILES['Imagen_Producto']['error'] == 0) {
        $imagen_nombre = $_FILES['Imagen_Producto']['name'];
        $imagen_temporal = $_FILES['Imagen_Producto']['tmp_name'];

        // Directorio donde se guardarán las imágenes
        $directorio_destino = "img/" . basename($imagen_nombre);

        if (move_uploaded_file($imagen_temporal, $directorio_destino)) {
            // Insertar datos en la base de datos
            $Insert = "INSERT INTO `productos`(`Nombre del producto`, `Precio unitario`, `Imagen`) 
                       VALUES ('$Nombre_Producto', '$Precio_Producto', '$directorio_destino')";

            if (mysqli_query($conn, $Insert)) {
                echo "Producto agregado correctamente.";
            } else {
                echo "Error al insertar datos: " . mysqli_error($conn);
            }
        } else {
            echo "Error al subir la imagen.";
        }
    } else {
        echo "No se subió ninguna imagen o hubo un error en la carga del archivo.";
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conn);
}
?>
