<?php
session_start();

$correct_password = "mortadela"; // Cambia esto por la contraseña que desees
$message = "";
$formData = []; // Inicializar variable de datos

// Recuperar datos de sesión si existen
if (isset($_SESSION['formData'])) {
    $formData = $_SESSION['formData'];
}

$is_logged_in = false; // Variable para verificar si el usuario está autenticado

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Manejar la contraseña
    if (isset($_POST['password']) && $_POST['password'] === $correct_password) {
        $is_logged_in = true; // El usuario está autenticado
    } else if (isset($_POST['password'])) {
        $message = "Contraseña incorrecta.";
    }

    // Borrar un registro específico
    if (isset($_POST['delete_record'])) {
        $index = $_POST['record_index'];
        if (isset($_SESSION['formData'][$index])) {
            unset($_SESSION['formData'][$index]); // Eliminar el registro seleccionado
            $_SESSION['formData'] = array_values($_SESSION['formData']); // Reindexar el array
            // Actualizamos $formData después de eliminar
            $formData = $_SESSION['formData'];
        }
    }

    // Limpiar todos los registros
    if (isset($_POST['clear_records'])) {
        unset($_SESSION['formData']); // Limpiar datos de sesión
        $formData = []; // Reiniciar variable de datos
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>Consulta de Registros</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        .form-container {
            max-width: 600px;
            margin: 0 auto; /* Centrar el formulario */
            padding: 2rem;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1>Consulta de Registros</h1>

        <?php if (!$is_logged_in): ?>
            <form action="" method="post" class="form-container">
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Consultar Registros</button>
            </form>

            <?php if ($message): ?>
                <div class="alert alert-danger mt-3"><?php echo $message; ?></div>
            <?php endif; ?>
        <?php else: ?>
            <h2 class="mt-5">Datos recibidos</h2>
            <?php if (count($formData) > 0): ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Email</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Fecha de Registro</th>
                            <th>Contraseña</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($formData as $index => $data): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($data['name']); ?></td>
                                <td><?php echo htmlspecialchars($data['surname']); ?></td>
                                <td><?php echo htmlspecialchars($data['email']); ?></td>
                                <td><?php echo htmlspecialchars($data['birthdate']); ?></td>
                                <td><?php echo htmlspecialchars($data['registration_date']); ?></td>
                                <td><?php echo htmlspecialchars($data['password']); ?></td>
                                <td>
                                    <form action="" method="post" style="display:inline;">
                                        <input type="hidden" name="record_index" value="<?php echo $index; ?>">
                                        <button type="submit" name="delete_record" class="btn btn-danger btn-sm">Borrar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <form action="" method="post" class="mt-3">
                    <button type="submit" name="clear_records" class="btn btn-danger">Borrar Todos los Registros</button>
                </form>
            <?php else: ?>
                <p class="text-center">No hay datos disponibles.</p>
            <?php endif; ?>
        <?php endif; ?>
        
        <a href="index.php" class="btn btn-secondary mt-3">Regresar al Formulario</a>
    </div>
</body>
</html>
