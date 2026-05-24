<?php
require_once 'config.php';
require_once 'App/models/Model.php';

class ClienteModel {
    private $db;

    public function __construct() {
      $this->db = new PDO('mysql:host=localhost;dbname=db_planes_cuotas;charset=utf8', 'root', '');
    }

    public function getAllClientes() {
        $query = $this->db->prepare('SELECT * FROM cliente');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    public function insertCliente($nombre, $email, $imagen_url) {
        
        $query = $this->db->prepare('INSERT INTO cliente (nombre, email, imagen_url) VALUES (?, ?, ?)');
        $query->execute([$nombre, $email, $imagen_url]);
        
        return $this->db->lastInsertId();
    }
    public function getClienteById($id) {
        $query = $this->db->prepare('SELECT * FROM cliente WHERE id_cliente = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function deleteCliente($id) {
        $query = $this->db->prepare('DELETE FROM cliente WHERE id_cliente = ?');
        $query->execute([$id]);
    }

    public function updateCliente($id, $nombre, $email, $imagen_url) {
        $query = $this->db->prepare('UPDATE cliente SET nombre = ?, email = ?, imagen_url = ? WHERE id_cliente = ?');
        $query->execute([$nombre, $email, $imagen_url, $id]);
    }
}