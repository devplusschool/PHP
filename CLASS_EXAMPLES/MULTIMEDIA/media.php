<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>🎥 Galería de Videos PHP</title>
    <style>
        body { font-family: Arial, sans-serif; background: #eef; padding: 20px; }
        form {
            background: #fff;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        video {
            display: block;
            margin: 10px 0;
            max-width: 100%;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
        }
        .video-card {
            background: white;
            padding: 10px;
            border-radius: 10px;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <h1>🎥 Subir y ver videos</h1>

    <form method="post" enctype="multipart/form-data">
        <label>Selecciona un video:</label><br>
        <input type="file" name="video" accept="video/mp4,video/webm,video/ogg" required>
        <button type="submit">Subir Video</button>
    </form>

    <h2>📺 Galería de Videos:</h2>

    <?php
    $carpeta = "videos/";

    // Verifica si se subió un archivo
    if ($_FILES) {
        $nombre = $_FILES["video"]["name"];
        $tmp = $_FILES["video"]["tmp_name"];
        $tipo = mime_content_type($tmp);

        // Validar que sea un tipo de video permitido
        $permitidos = ["video/mp4", "video/webm", "video/ogg"];
        if (in_array($tipo, $permitidos)) {
            $destino = $carpeta . basename($nombre);
            if (move_uploaded_file($tmp, $destino)) {
                echo "<p>✅ Video subido correctamente: <b>$nombre</b></p>";
            } else {
                echo "<p style='color:red;'>❌ Error al mover el archivo.</p>";
            }
        } else {
            echo "<p style='color:red;'>⚠️ Tipo de archivo no permitido.</p>";
        }
    }

    // Mostrar todos los videos
    if (is_dir($carpeta)) {
        $archivos = array_diff(scandir($carpeta), ['.', '..']);
        if (count($archivos) === 0) {
            echo "<p>No hay videos aún.</p>";
        } else {
            foreach ($archivos as $archivo) {
                $ruta = $carpeta . $archivo;
                echo "<div class='video-card'>
                        <h3>$archivo</h3>
                        <video controls>
                            <source src='$ruta' type='video/mp4'>
                            Tu navegador no soporta el video.
                        </video>
                      </div>";
            }
        }
    }
    ?>
</body>
</html>
