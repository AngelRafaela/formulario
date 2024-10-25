<?php
session_start();

$message = "";
$name = "";
$surname = "";
$email = "";
$birthdate = "";
$registration_date = "";
$password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        // Procesar datos
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $birthdate = $_POST['birthdate'];
        $registration_date = $_POST['registration_date'];
        $password = $_POST['password'];

        // Guardar datos en sesión
        $_SESSION['formData'][] = [
            'name' => $name,
            'surname' => $surname,
            'email' => $email,
            'birthdate' => $birthdate,
            'registration_date' => $registration_date,
            'password' => $password,
        ];

        $message = "Datos recibidos correctamente!";

        // Limpiar campos después de guardar
        $name = "";
        $surname = "";
        $email = "";
        $birthdate = "";
        $registration_date = "";
        $password = "";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>Datos Personales</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        .form-container {
            max-width: 500px; /* Ancho máximo del formulario */
            margin: auto; /* Centrar horizontalmente */
            padding: 20px; /* Espaciado interno */
            border: 1px solid #ccc; /* Opcional: borde */
            border-radius: 5px; /* Opcional: bordes redondeados */
            background-color: #f9f9f9; /* Opcional: color de fondo */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">LOGIN</h1>
        <div class="form-container">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" required value="<?php echo htmlspecialchars($name); ?>">
                </div>
                <div class="mb-3">
                    <label for="surname" class="form-label">Apellido</label>
                    <input type="text" class="form-control" id="surname" name="surname" required value="<?php echo htmlspecialchars($surname); ?>">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required value="<?php echo htmlspecialchars($email); ?>">
                    <div class="form-text">Nunca compartiremos tu email con nadie más.</div>
                </div>
                <div class="mb-3">
                    <label for="birthdate" class="form-label">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" id="birthdate" name="birthdate" required value="<?php echo htmlspecialchars($birthdate); ?>">
                </div>
                <div class="mb-3">
                    <label for="registration_date" class="form-label">Fecha de Registro</label>
                    <input type="date" class="form-control" id="registration_date" name="registration_date" required value="<?php echo htmlspecialchars($registration_date); ?>">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required value="<?php echo htmlspecialchars($password); ?>">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Enviar</button>
            </form>
            <a href="registros.php" class="btn btn-info mt-3">Consultar Registros</a>
        </div>
    </div>
</body>
</html>

