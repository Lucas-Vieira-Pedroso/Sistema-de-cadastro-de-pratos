CREATE DATABASE IF NOT EXISTS pratos_m1;
USE pratos_m1;

CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome_usuario VARCHAR(200) NOT NULL,
    email VARCHAR(200) NOT NULL
);

CREATE TABLE IF NOT EXISTS pratos (
    id_pratos INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    nome_prato VARCHAR(200) NOT NULL,
    descricao VARCHAR(255) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    categoria VARCHAR(100) NOT NULL,
    CONSTRAINT fk_pratos_usuarios FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);