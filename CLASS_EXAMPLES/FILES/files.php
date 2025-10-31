<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Libro de Visitas</title>
    <style>
        body { font-family: Arial; background: #eef; padding: 20px; }
        form { background: #fff; padding: 15px; border-radius: 10px; }
        textarea, input { width: 100%; margin: 5px 0; padding: 8px; }
        .mensaje {
            background: white;
            padding: 10px;
            margin: 10px 0;
            border-left: 4px solid #4a90e2;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>💬 Libro de visitas</h1>
    <form method="post">
        <input type="text" name="usuario" placeholder="Tu nombre" required>
        <textarea name="mensaje" placeholder="Escribe tu mensaje..." required></textarea>
        <button type="submit">Guardar</button>
    </form>

    <hr>
    <h2>Mensajes guardados:</h2>

    <?php
    $archivo = "mensajes.txt";

    // Si se envió el formulario...
    if ($_POST) {
        $usuario = trim($_POST['usuario']);
        $mensaje = trim($_POST['mensaje']);

        if ($usuario !== "" && $mensaje !== "") {
            $linea = date("d/m/Y H:i") . " | " . $usuario . " | " . $mensaje . "\n";
            // Guarda en el archivo (lo crea si no existe)
            file_put_contents($archivo, $linea, FILE_APPEND);
        }
    }

    // Mostrar los mensajes
    if (file_exists($archivo)) {
        $lineas = file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $lineas = array_reverse($lineas); // Mostrar los más nuevos arriba
        foreach ($lineas as $linea) {
            $partes = explode("|", $linea);
            echo "<div class='mensaje'><b>" . htmlspecialchars($partes[1]) . "</b> (" . trim($partes[0]) . ")<br>"
               . htmlspecialchars($partes[2]) . "</div>";
        }
    } else {
        echo "<p>No hay mensajes aún.</p>";
    }
    ?>
</body>
</html>
