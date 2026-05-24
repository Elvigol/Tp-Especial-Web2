<?php
require_once 'config.php';

class Database
{
    public static function getConnection()
    {
        $db = new PDO('mysql:host=' . DB_HOST . ';charset=' . DB_CHARSET, DB_USER, DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = $db->query("SHOW DATABASES LIKE '" . DB_NAME . "'");
        
        if ($query->rowCount() == 0) {
            // 3. AUTO DEPLOY: Si no existe, creamos la base y la seleccionamos
            $db->exec("CREATE DATABASE IF NOT EXISTS `" . DB_NAME . "`");
            $db->exec("USE `" . DB_NAME . "`");
            
           
            $sql = <<<END
            CREATE TABLE `cliente` (
              `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
              `nombre` varchar(100) NOT NULL,
              `email` varchar(150) NOT NULL,
              `imagen_url` varchar(255) DEFAULT NULL,
              PRIMARY KEY (`id_cliente`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

            CREATE TABLE `plan_de_cuotas` (
              `id_plan` int(11) NOT NULL AUTO_INCREMENT,
              `id_cliente` int(11) NOT NULL,
              `categoria` varchar(50) NOT NULL,
              `descripcion` varchar(200) NOT NULL,
              `monto_total` decimal(10,2) NOT NULL,
              PRIMARY KEY (`id_plan`),
              FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

            CREATE TABLE `usuario` (
                `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
                `username` varchar(50) NOT NULL,
                `password` varchar(255) NOT NULL,
                PRIMARY KEY (`id_usuario`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

            -- Usuario administrador requerido por la consigna
            INSERT INTO `usuario` (`username`, `password`) VALUES ('webadmin', 'admin'); 
            
            -- Clientes de prueba con imágenes de avatar por defecto
            INSERT INTO `cliente` (`nombre`, `email`, `imagen_url`) VALUES 
            ('Juan Perez', 'juan@gmail.com', 'https://cdn-icons-png.flaticon.com/512/3135/3135715.png'),
            ('Maria Gomez', 'maria@gmail.com', 'https://cdn-icons-png.flaticon.com/512/3135/3135768.png');

            -- Planes de prueba
            INSERT INTO `plan_de_cuotas` (`id_cliente`, `categoria`, `descripcion`, `monto_total`) VALUES 
            (1, 'Viajes', 'Viaje a Bariloche', 150000.00);
END;
            $db->exec($sql);
        } else {
           
            $db->exec("USE `" . DB_NAME . "`");
        }

        return $db;
    }
}