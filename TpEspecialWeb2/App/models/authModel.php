<?php
require_once 'config.php';
require_once 'Model.php'; // Asegurate de que este archivo contenga tu clase Database

class AuthModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getUsuarioByUsername($username) {
        $query = $this->db->prepare('SELECT * FROM usuario WHERE username = ?');
        $query->execute([$username]);
        // Devolvemos el usuario (si existe) como un objeto
        return $query->fetch(PDO::FETCH_OBJ);
    }
}