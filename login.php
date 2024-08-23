<?php

session_start();

if (isset($_SESSION['is_admin'])) {
    if ($_SESSION['is_admin']) {
        header("Location: admin.php");
        exit();
    } else {
        header("Location: index.html");
        exit();
    }
}

// Procesar el formulario de login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['contraseña'];

    if ($password === '12345') {
        // Contraseña de administrador correcta
        $_SESSION['is_admin'] = true;
        header("Location: admin.php");
        exit();
    } else {
        // Redirigir al usuario normal a la página principal
        $_SESSION['is_admin'] = false;
        header("Location: index.html");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="author" content="Kodinger">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Logeo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/my-login.css">
</head>
<body class="my-login-page">
    <style>
        body {
            background-image: url(img/back-login.webp);
            background-repeat: no-repeat;
            background-size: 1450px;
        }
    </style>
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-md-center h-100">
                <div class="card-wrapper">
                    <div class="brand">
                        
                    </div>
                    <div class="card fat">
                        <div class="card-body">
                            <h4 class="card-title">Inicio de sesión</h4>
                            <form method="POST" class="my-login-validation" novalidate="" id="login" action="login.php">
                                <div class="form-group">
                                    <label for="email">Correo electrónico</label>
                                    <input id="email" type="email" class="form-control" name="email" required autofocus>
                                    <div class="invalid-feedback">
                                        Correo electrónico inválido
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <input id="password" type="password" class="form-control" name="contraseña" required data-eye>
                                    <div class="invalid-feedback">
                                        Contraseña requerida
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" name="remember" id="remember" class="custom-control-input">
                                        <label for="remember" class="custom-control-label">¿Recordar esta contraseña?</label>
                                    </div>
                                </div>

                                <div class="form-group m-0">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        Inicio
                                    </button>
                                </div>
                                <div class="mt-4 text-center">
                                    ¿No tiene una cuenta? <a href="register.html">¡Crea una!</a>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="footer">
                        Copyright &copy; 2017 &mdash; Mundo Deporte
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="js/my-login.js"></script>
</body>
</html>