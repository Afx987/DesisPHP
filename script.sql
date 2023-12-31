CREATE DATABASE IF NOT EXISTS desis;
USE desis;

CREATE TABLE IF NOT EXISTS votos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombres_apellidos VARCHAR(255) NOT NULL,
    alias VARCHAR(50) NOT NULL,
    rut VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    region VARCHAR(100) NOT NULL,
    comuna VARCHAR(100) NOT NULL,
    candidato VARCHAR(100) NOT NULL,
    referencias VARCHAR(255) NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

