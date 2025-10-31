<form method="post">
    <input type="text" name="nombre" placeholder="Tu nombre">
    <button type="submit">Saludar</button>
</form>

<?php
if ($_POST) {
    echo "<h2>¡Hola, " . htmlspecialchars($_POST['nombre']) . "!</h2>";
}
?>
