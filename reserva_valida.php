<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva válida</title>
</head>
<body>
    <?php
        session_start();

        $datos = $_SESSION['datos'];

    ?>
    <h1>Reserva válida</h1>
    <p><?php echo $datos['nombre'].' '.$datos['apellido'] ?></p>
    <?php
        if ($datos['modelo'] = 'lancia_stratos')
            {echo '<img src="images\lancia_stratos.jpg">';}
        elseif ($datos['modelo'] = 'audi_quattro')
            {echo '<img src="images\audi_quattro.jpg">';}
        elseif ($datos['modelo'] = 'ford_escort_rs1800')
            {echo '<img src="images\ford_escort_rs1800.jpg">';}
        elseif ($datos['modelo'] = 'subaru_impreza_555')
            {echo '<img src="images\subaru_impreza_555.jpg">';}
    ?>
</body>
</html>