<?php

session_start();

function validar_dni($dni){
    $letter = substr($dni, -1);
    $numbers = substr($dni, 0, -1);
  
    if (substr("TRWAGMYFPDXBNJZSQVHLCKE", $numbers%23, 1) == $letter && strlen ($numbers) == 8 ){
      return true;
    }
    return false;
}

function usuario_existe($dni, $nombre, $apellido) {
    foreach (USUARIOS as $usuario) {
        if ($usuario["dni"] === $dni && $usuario["nombre"] === $nombre && $usuario["apellido"] === $apellido) {
            return true;
        }
    }
    return false;
}

function vehiculo_disponible($modelo) {
    global $coches;
    foreach ($coches as $vehiculo) {
        if ($vehiculo["modelo"] == $modelo && $vehiculo["disponible"] === true) {
            return true;
        }
    }
    return false;
}


$coches = array(
    array(
        "id" => 1,
        "modelo" => "Lancia Stratos",
        "disponible" => true,
        "fecha_inicio" => null,  // Fecha de inicio en formato Y-M-D
        "fecha_fin" => null      // Fecha de fin en formato Y-M-D
    ),
    array(
        "id" => 2,
        "modelo" => "Audi Quattro",
        "disponible" => true,
        "fecha_inicio" => null,
        "fecha_fin" => null
    ),
    array(
        "id" => 3,
        "modelo" => "Ford Escort RS1800",
        "disponible" => false,
        "fecha_inicio" => "2024-10-25",
        "fecha_fin" => "2024-11-02"
    ),
    array(
        "id" => 4,
        "modelo" => "Subaru Impreza 555",
        "disponible" => true,
        "fecha_inicio" => null,
        "fecha_fin" => null
    )
);

define('USUARIOS',
array(
    array(
        "nombre" => "Iker",
        "apellido" => "Arana",
        "dni" => "12345678Z"
    ),
    array(
        "nombre" => "María",
        "apellido" => "Gómez",
        "dni" => "87654321X"
    ),
    array(
        "nombre" => "Carlos",
        "apellido" => "López",
        "dni" => "13579246T"
    ),
    array(
        "nombre" => "Laura",
        "apellido" => "Martínez",
        "dni" => "24681357B"
    )
));


$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$dni = $_POST["dni"];
$modelo = $_POST["modelo"];
$fecha_ini = $_POST["fecha_ini"];
$duracion = $_POST["duracion"];
$error = 0;

if (empty($nombre)) 
    {$datos['nombre'] = 'El nombre no debe estar vacío.';
    $error = 1;
    $errores['nombre'] = true;}
else {$datos['nombre'] = $nombre;
    $errores['nombre'] = false;}

if (empty($apellido)) 
    {$datos['apellido'] = 'El apellido no debe estar vacío.';
    $error = 1;
    $errores['apellido'] = true;}
else {$datos['apellido'] = $apellido;
    $errores['apellido'] = false;}

if (!validar_dni($dni)) 
    {$datos['dni'] = 'El DNI no es válido.';
    $datos['registrado'] = 'El usuario no es válido.';
    $error = 1;
    $errores['dni'] = true;
    $errores['registrado'] = true;}
else {$datos['dni'] = $dni;
    $datos['registrado'] = 'El usuario es válido.';
    $errores['dni'] = false;
    $errores['registrado'] = false;}

if (!usuario_existe($dni, $nombre, $apellido)) 
    {$datos['registrado'] = 'El usuario no es válido.';
    $error = 1;
    $errores['registrado'] = true;}

$fecha_ini = date('Y-m-d', strtotime($_POST["fecha_ini"]));
$fecha_actual = date('Y-m-d');
if ($fecha_ini <= $fecha_actual) 
    {$datos['fecha_ini'] = 'La fecha de inicio debe ser futura.';
    $error = 1;
    $errores['fecha_ini'] = true;}
else {$datos['fecha_ini'] = $fecha_ini;
    $errores['fecha_ini'] = false;}

if ($duracion < 1 || $duracion > 30) 
    {$datos['duracion'] = 'Duración entre 1 y 30 días.';
    $error = 1;
    $errores['duracion'] = true;}
else {$datos['duracion'] = $duracion;
    $errores['duracion'] = false;}

if (!vehiculo_disponible($modelo)) 
    {$datos['modelo'] = 'Vehículo no disponible.';
    $error = 1;
    $errores['modelo'] = true;}
else {$datos['modelo'] = $modelo;
    $errores['modelo'] = false;}

$_SESSION['datos'] = $datos;
$_SESSION['errores'] = $errores;

if ($error == 0) {
    header("Location: reserva_valida.php");
} else {
    header("Location: reserva_invalida.php");
}

?>
