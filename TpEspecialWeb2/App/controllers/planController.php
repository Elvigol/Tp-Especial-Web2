<?php
require_once 'app/models/planModel.php';
require_once 'app/views/planView.php';
require_once 'app/views/errorView.php';

class PlanController {
    private $model;
    private $view;
    private $errorView;

    public function __construct() {
        $this->model = new PlanModel();
        $this->view = new PlanView();
        $this->errorView = new ErrorView();
    }

    private function checkLoggedIn() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['IS_LOGGED'])) {
            header("Location: " . BASE_URL . "login");
            die();
        }
    }

   
    public function showAllPlanes() {
        $planes = $this->model->getAllPlanes();
        $this->view->showPlanes($planes);
    }

    public function showPlanById($id) {
        $plan = $this->model->getPlanById($id);
        if (!$plan) {
            return $this->errorView->renderError("No existe el plan solicitado.");
        }
        $this->view->showPlanDetalle($plan);
    }

    public function showFormularioAlta() {
        $this->checkLoggedIn();

        $clienteModel = new ClienteModel();
        $clientes = $clienteModel->getAllClientes();
        $this->view->showAddForm($clientes);
    }

  public function add() {
    $this->checkLoggedIn();
    if (empty($_POST['descripcion']) || empty($_POST['monto_total'])) {
        $this->view->showError("Faltan datos obligatorios");
        return;
    }

    $descripcion = $_POST['descripcion'];
    $categoria = $_POST['categoria'];
    $monto = $_POST['monto_total'];
    $id_cliente = $_POST['id_cliente'];

    
    
    $this->model->insertPlan($id_cliente, $categoria, $descripcion, $monto);

   header("Location: " . BASE_URL . "planes");
    die();
}

   public function delete($id) {
    $this->checkLoggedIn(); 
    
    // 1. Opcional: Verificar si el plan existe antes de borrar
    $plan = $this->model->getPlanById($id);
    if (!$plan) {
        $this->errorView->renderError("No se encontró el plan con ID: $id");
        return;
    }
    $this->model->deletePlan($id);
    header("Location: " . BASE_URL . "planes");
}
public function update($id) {
    $this->checkLoggedIn(); // Seguridad

    if (!isset($_POST['descripcion'], $_POST['categoria'], $_POST['monto_total'], $_POST['id_cliente'])) {
        return $this->errorView->renderError("Faltan campos obligatorios.");
    }

    $descripcion = $_POST['descripcion'];
    $categoria = $_POST['categoria'];
    $monto = $_POST['monto_total'];
    $id_cliente = $_POST['id_cliente'];

    
    $this->model->updatePlan($id, $id_cliente, $categoria, $descripcion, $monto);

   
    header("Location: " . BASE_URL . "planes");
    die();
}
public function showFormularioEditar($id) {
    $this->checkLoggedIn(); // Seguridad 
    $plan = $this->model->getPlanById($id); 
    $clienteModel = new ClienteModel();
    $clientes = $clienteModel->getAllClientes();
    $this->view->showEditForm($plan, $clientes);
}

public function showPlanesByCliente($id_cliente) {
    $planes = $this->model->getPlanesByCliente($id_cliente);
    
    $this->view->showPlanes($planes);
}
}