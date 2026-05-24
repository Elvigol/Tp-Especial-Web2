<?php
require_once 'config.php'; 
 

class PlanModel {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAllPlanes() {
        
        $query = $this->db->prepare('
            SELECT plan_de_cuotas.*, cliente.nombre AS nombre_cliente 
            FROM plan_de_cuotas 
            JOIN cliente ON plan_de_cuotas.id_cliente = cliente.id_cliente
        ');
        $query->execute();

        $planes = $query->fetchAll(PDO::FETCH_OBJ);
        
        return $planes;
    }
    public function insertPlan($id_cliente, $categoria, $descripcion, $monto_total) {
        $query = $this->db->prepare('INSERT INTO plan_de_cuotas (id_cliente, categoria, descripcion, monto_total) VALUES (?, ?, ?, ?)');
        $query->execute([$id_cliente, $categoria, $descripcion, $monto_total]);
        return $this->db->lastInsertId();
    }
    public function deletePlan($id) {
        $query = $this->db->prepare('DELETE FROM plan_de_cuotas WHERE id_plan = ?');
        $query->execute([$id]);
    }
    
    public function getPlanById($id) {
        $query = $this->db->prepare('
            SELECT plan_de_cuotas.*, cliente.nombre AS nombre_cliente 
            FROM plan_de_cuotas 
            JOIN cliente ON plan_de_cuotas.id_cliente = cliente.id_cliente
            WHERE plan_de_cuotas.id_plan = ?
        ');
        $query->execute([$id]);

        return $query->fetch(PDO::FETCH_OBJ);
    }
    public function updatePlan($id, $id_cliente, $categoria, $descripcion, $monto_total) {
        $query = $this->db->prepare('UPDATE plan_de_cuotas SET id_cliente = ?, categoria = ?, descripcion = ?, monto_total = ? WHERE id_plan = ?');
        $query->execute([$id_cliente, $categoria, $descripcion, $monto_total, $id]);
    }
    public function getPlanesByCliente($id_cliente) {
        $query = $this->db->prepare('
            SELECT plan_de_cuotas.*, cliente.nombre AS nombre_cliente 
            FROM plan_de_cuotas 
            JOIN cliente ON plan_de_cuotas.id_cliente = cliente.id_cliente
            WHERE plan_de_cuotas.id_cliente = ?
        ');
        $query->execute([$id_cliente]);

       
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}