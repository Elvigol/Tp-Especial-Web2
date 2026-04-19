# Tp-Especial-Web2
Elvio Conqueiro elvioconque@gmail.com
Santiago Parasuco santiparasuco@gmail.com

La tematica del trabajo sera una tienda de deportes 

CREATE DATABASE IF NOT EXISTS tienda_deportes_db;
USE tienda_deportes_db;

-- Tabla de Categorías (Lado 1)
CREATE TABLE categoria (
    id_categoria INT(11) NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    PRIMARY KEY (id_categoria)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla de Productos (Lado N)
CREATE TABLE producto (
    id_producto INT(11) NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(150) NOT NULL,
    marca VARCHAR(100) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    stock INT(11) DEFAULT 0,
    id_categoria INT(11) NOT NULL,
    PRIMARY KEY (id_producto),
    KEY fk_categoria (id_categoria),
    CONSTRAINT fk_categoria FOREIGN KEY (id_categoria) REFERENCES categoria (id_categoria) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla de Usuarios (Administración)
CREATE TABLE usuario (
    id_usuario INT(11) NOT NULL AUTO_INCREMENT,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    es_admin BOOLEAN DEFAULT FALSE,
    PRIMARY KEY (id_usuario)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Inserción de datos de prueba
INSERT INTO categoria (nombre, descripcion) VALUES 
('Calzado', 'Zapatillas, botines y ojotas'), 
('Indumentaria', 'Remeras, shorts, pantalones y camperas'),
('Accesorios', 'Pelotas, raquetas, mochilas y gorras');

INSERT INTO producto (nombre, marca, precio, stock, id_categoria) VALUES 
('Botines Predator', 'Adidas', 150000.00, 15, 1), 
('Zapatillas Running Revolution', 'Nike', 95000.00, 20, 1), 
('Camiseta Selección Argentina', 'Adidas', 80000.00, 50, 2),
('Short Entrenamiento', 'Puma', 35000.00, 30, 2),
('Pelota Básquet Spalding', 'Spalding', 45000.00, 10, 3);
