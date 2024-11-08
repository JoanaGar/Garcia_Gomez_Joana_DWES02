<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva no válida</title>
</head>
<body>
    <h1>Reserva no válida</h1>

    '<p><span style="color: red"></span></p>'
    <?php
        session_start();

        $datos = $_SESSION['datos'];
        $errores = $_SESSION['errores'];

        echo "<form>";
        foreach ($errores as $campo => $error) {
            // Verificamos si hay un error para este campo
            if ($error) {
                // Si hay error, mostramos el valor de los datos con el mensaje de error
                echo "<p><span style='color: red;'>" . $datos[$campo] . "</span></p>";
                
            } else {
                $campo_may = ucfirst($campo);
                // Si no hay error, solo mostramos el valor
                echo "<p><span style='color: green;'>" . $campo_may . ": ". $datos[$campo] . "</span></p>";
            }
        }
        echo "</form>";

    ?>
</body>
</html>