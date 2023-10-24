<?php
namespace DesisPHP;

use app\controllers\VotacionController;
use mysqli;

require_once __DIR__ . '/app/controllers/VotacionController.php';
require_once __DIR__ . '/vendor/autoload.php';

$host = 'localhost';
$usuario = 'root';
$contrasena = 'admin';
$base_datos = 'desis';

$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

if ($conexion->connect_error) {
    die('Error de conexión a la base de datos: ' . $conexion->connect_error);
}

$conexion->set_charset('utf8');

$controller = new VotacionController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $controller->procesarVoto();
} else {

    $controller->mostrarFormulario();
}
