<?php
namespace app\service;

class DatosDesdeBD
{
    private $conexion;

    public function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    public function cargarVotos()
    {
        $sql = "SELECT * FROM votos";
        $resultado = $this->conexion->query($sql);

        $votos = [];
        while ($fila = $resultado->fetch_assoc()) {
            $votos[] = $fila;
        }

        return $votos;
    }
}