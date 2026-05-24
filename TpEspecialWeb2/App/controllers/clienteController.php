<?php<?php
require_once 'app/models/clienteModel.php';
require_once 'app/views/clienteView.php';
require_once 'app/views/errorView.php';
class clienteController {
      private $model;
    private $view;
    private $errorView;

    public function __construct() {
        $this->model = new ClienteModel();
        $this->view = new ClienteView();
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

    public function showAllClientes() {
        $clientes = $this->model->getAllClientes();
        $this->view->showClientes($clientes);
    }

    public function showFormularioAlta() {
        $this->checkLoggedIn();
        $this->view->showAddForm();
    }

    public function add() {
        $this->checkLoggedIn();

        if (!isset($_POST['nombre']) || empty($_POST['nombre']) || !isset($_POST['email']) || empty($_POST['email'])) {
            return $this->errorView->renderError("Por favor, complete el nombre y el email.");
        }

        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $imagen_url = !empty($_POST['imagen_url']) ? $_POST['imagen_url'] : null;

        $id = $this->model->insertCliente($nombre, $email, $imagen_url);

        if (empty($id)) {
            return $this->errorView->renderError("Error al agregar el cliente.");
        }
        
        header("Location: " . BASE_URL . "clientes");
    }

    public function delete($id) {
        $this->checkLoggedIn();

        $cliente = $this->model->getClienteById($id);
        if (!$cliente) {
            return $this->errorView->renderError("No existe el cliente con el id=$id");
        }

        $this->model->deleteCliente($id);
        header("Location: " . BASE_URL . "clientes");
    }

    public function showFormularioEditar($id) {
        $this->checkLoggedIn();

        $cliente = $this->model->getClienteById($id);
        if (!$cliente) {
            return $this->errorView->renderError("El cliente que intentas editar no existe.");
        }

        $this->view->showEditForm($cliente);
    }

    public function update($id) {
        $this->checkLoggedIn();

        if (!isset($_POST['nombre']) || empty($_POST['nombre']) || !isset($_POST['email']) || empty($_POST['email'])) {
            return $this->errorView->renderError("Por favor, complete el nombre y el email.");
        }

        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $imagen_url = !empty($_POST['imagen_url']) ? $_POST['imagen_url'] : null;

        $this->model->updateCliente($id, $nombre, $email, $imagen_url);
        
        header("Location: " . BASE_URL . "clientes");
    }

}