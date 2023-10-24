<?php
namespace app\controllers;

use app\service\DatosDesdeBD;
use Exception;
use mysqli;

require_once __DIR__ . '/../../index.php';
require_once __DIR__ . '/../service/DatosDesdeBD.php';


class VotacionController
{
    private $datosDesdeBD;
    private $conexion;
    public function __construct()
    {
        $host = 'localhost';
        $usuario = 'root';
        $contrasena = 'admin';
        $base_datos = 'desis';

        $this->conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

        if ($this->conexion->connect_error) {
            die('Error de conexión a la base de datos: ' . $this->conexion->connect_error);
        }

        $this->conexion->set_charset('utf8');

        $this->datosDesdeBD = new DatosDesdeBD($this->conexion);
    }
    public function obtenerConexion()
    {
        return $this->conexion;
    }

    public function mostrarFormulario()
    {
        $votos = $this->datosDesdeBD->cargarVotos();
        // Muestra el formulario con los datos cargados
        include __DIR__ . '/../views/votacion.php';
    }

    public function procesarVoto()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["votar"])) {
            $nombresApellidos = $_POST["nombres_apellidos"];
            $alias = $_POST["alias"];
            $rut = $_POST["rut"];
            $email = $_POST["email"];
            $region = $_POST["region"];
            $comuna = $_POST["comuna"];
            $candidato = $_POST["candidato"];
            $referencias = isset($_POST["referencias"]) ? $_POST["referencias"] : [];
    
            $datosFormulario = [
                'nombres_apellidos' => $nombresApellidos,
                'alias' => $alias,
                'rut' => $rut,
                'email' => $email,
                'region' => $region,
                'comuna' => $comuna,
                'candidato' => $candidato,
                'referencias' => $referencias
            ];
    
            $errores = $this->validarFormulario($datosFormulario);
    
            if (!empty($errores)) {
                echo "Error en registrar el voto";
                include __DIR__ . '/../views/votacion.php';
            } else {
    
                $conexion = $this->obtenerConexion();
    
                if ($conexion->connect_error) {
                    die("Conexión fallida: " . $conexion->connect_error);
                }
    
                $sql = "INSERT INTO votos (nombres_apellidos, alias, rut, email, region, comuna, candidato, referencias) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
                $stmt = $conexion->prepare($sql);
    
                $stmt->bind_param("ssssssss", $nombresApellidos, $alias, $rut, $email, $region, $comuna, $candidato, implode(", ", $referencias)); 
    
                if ($stmt->execute()) {
                    $stmt->close();
                    $conexion->close();
    
                    echo "Se registró el voto";
                    exit;
                } else {
                    echo "Error en registrar el voto";
                    $stmt->close();
                    $conexion->close();
                }
            }
        }
    }
    

    private function validarFormulario($datos)
    {
        $errores = [];

        if (empty($datos['nombres_apellidos'])) {
            echo "El campo Nombre y Apellido es obligatorio \n";
        }

        if (strlen($datos['alias']) < 6 || !preg_match('/^[a-zA-Z0-9]+$/', $datos['alias'])) {
            echo "El Alias debe tener al menos 6 caracteres y contener letras y números \n";
        }

        if (!$this->validarRUT($datos['rut'])) {
            echo "RUT inválido \n";
        }

        if (!filter_var($datos['email'], FILTER_VALIDATE_EMAIL)) {
            echo "Email inválido \n";
        }

        if (empty($datos['region']) || empty($datos['comuna'])) {
            echo 'Debes seleccionar una Región y una Comuna \n';
        }

        if (isset($datos['referencia']) && is_array($datos['referencia']) && count($datos['referencia']) < 2) {
            echo 'Debes seleccionar al menos dos opciones \n.';
        }
        

        if ($this->existeVotoPorRUT($datos['rut'])) {
            echo 'Ya has votado antes \n.';
        }

        return $errores;
    }

    private function validarRUT($rut)
    {
        $rut = preg_replace('/[\.\-]/', '', $rut);

        if (strlen($rut) < 8) {
            return false; // RUT inválido
        }

        $rut = str_pad($rut, 9, '0', STR_PAD_LEFT);
        $digito_verificador = strtoupper($rut[8]);

        $suma = 0;
        for ($i = 0; $i < 8; $i++) {
            $suma += intval($rut[$i]) * (9 - $i);
        }

        $resto = $suma % 11;
        $dv_calculado = 11 - $resto;

        if ($dv_calculado == 10) {
            $dv_calculado = 'K';
        } elseif ($dv_calculado == 11) {
            $dv_calculado = '0';
        }

        return $digito_verificador == $dv_calculado;
    }

   
    private function existeVotoPorRUT($rut)
    {
        $conexion = $this->obtenerConexion();
        $sql = "SELECT COUNT(*) AS count FROM votos WHERE rut = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $rut);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();
    
        // Agrega declaraciones de depuración
        echo "Número de votos encontrados: " . $count . "<br>";
    
        return $count > 0;
    }
    
}
