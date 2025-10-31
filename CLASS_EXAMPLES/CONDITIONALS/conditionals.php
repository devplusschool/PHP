<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acceso con decisión</title>
    <style>
        body { font-family: Arial; background: #eef; padding: 20px; }
        form { margin-bottom: 20px; }
        .card {
            background: white; 
            padding: 15px; 
            border-radius: 10px; 
            box-shadow: 0 0 5px rgba(0,0,0,0.2);
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <h1>Control de acceso</h1>
    <form method="post">
        <input type="number" name="edad" placeholder="Tu edad" required>
        <button type="submit">Ver contenido</button>
    </form>

    <?php
    if ($_POST) {
        $edad = $_POST['edad'];

        if ($edad >= 18) {
            echo "<h2>Acceso permitido ✅</h2>";
            echo "<p>Lo que sabemos del 3i atlas:</p>";

            $archivo = "atlas3i.txt";

            if (file_exists($archivo)) {
                $lineas = file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                foreach ($lineas as $linea) {
                    echo "<div class='card'>" . htmlspecialchars($linea) . "</div>";
                }
            } else {
                echo "<p style='color:red;'>No se encontró el archivo de datos 😕</p>";
            }

        } else {
            echo "<p style='color:red;'>Acceso denegado ❌ — contenido solo para mayores de edad.</p>";
        }
    }
    ?>
</body>
</html>
