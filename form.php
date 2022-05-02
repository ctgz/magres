<?php
include("gracias.html");

error_reporting(E_ALL);

$Email = $_POST['Email'];

if (!empty($_POST['Nombre']) && is_string($_POST['Nombre'])) {
    $Nombre = $_POST['Nombre'];
}

if (!empty($_POST['Apellido']) && is_string($_POST['Apellido'])) {
    $Apellido = $_POST['Apellido'];
}

if (!empty($_POST['Telefono']) && is_numeric($_POST['Telefono'])) {
    $Telefono = $_POST['Telefono'];
}

if (!empty($Email) && is_string($Email) ){
$Email = filter_var($Email, FILTER_VALIDATE_EMAIL);
}

//Conexión base de datos
$connection = new mysqli('localhost', 'root', '', 'magres_form');

if ($connection->errno !== 0) {
    die('Hubo un error en la conexión');
}

$Nombre        = trim($_POST['Nombre']);
mysqli_real_escape_string($connection, $Nombre);
$Apellido      = trim($_POST['Apellido']);
mysqli_real_escape_string($connection, $Apellido);
$Telfono       = intval($_POST['Telefono']);
mysqli_real_escape_string($connection, $Telefono);
$Email         = trim($_POST['Email']);
mysqli_real_escape_string($connection, $Email);
$mensaje       = trim($_POST['mensaje']);
mysqli_real_escape_string($connection, $mensaje);
$Fecha_Ingreso = date("d/m/y");


if (isset($_POST['Submit'])) {
    if (! empty($_POST['Nombre']) &&
        ! empty($_POST['Apellido']) &&
        ! empty($_POST['Telefono']) &&
        ! empty($_POST['Email']) &&
        ! empty($_POST['mensaje'])) { 
                $connection->query(
                    "INSERT INTO `magres_datos_form`( `NOMBRE`, `APELLIDO`, `EMAIL`, `TELEFONO`, `FECHA_INGRESO`, `MENSAJE`)
                    VALUES('$Nombre','$Apellido','$Email','$Telefono','$Fecha_Ingreso','$mensaje')",
                    );
        }
    }