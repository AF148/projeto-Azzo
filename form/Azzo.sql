CREATE DATABASE IF NOT EXISTS Azzo;
USE Azzo;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    telefone VARCHAR(15),
    sexo ENUM('Feminino', 'Masculino', 'Outro'),
    data_nascimento DATE,
    cidade VARCHAR(100),
    estado VARCHAR(100),
    endereco VARCHAR(255),
    senha VARCHAR(255) NOT NULL
);