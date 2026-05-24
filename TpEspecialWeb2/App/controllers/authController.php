<?php
require_once 'app/models/authModel.php';
require_once 'app/views/authView.php';

class AuthController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new AuthModel();
        $this->view = new AuthView();
    }
    public function checkLoggedIn() {
    session_start();
    if (!isset($_SESSION['ID_USER'])) {
        header("Location: " . BASE_URL . "login");
        die(); // Detiene la ejecución si no está logueado
    }
}

    public function showLogin() {
        $this->view->showLogin();
    }

    public function auth() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (empty($username) || empty($password)) {
            $this->view->showLogin("Faltan completar datos");
            return;
        }

        
        $user = $this->model->getUsuarioByUsername($username);

        
        if ($user && $user->password === $password) {
            
           
            session_start();
            $_SESSION['USER_ID'] = $user->id_usuario;
            $_SESSION['USER_NAME'] = $user->username;
            $_SESSION['IS_LOGGED'] = true;

        
            header("Location: " . BASE_URL . "planes");
        } else {
            
            $this->view->showLogin("Usuario o contraseña incorrectos");
        }
    }

    public function logout() {
        session_start();
        session_destroy(); // Destruimos los datos de la sesión
        header("Location: " . BASE_URL . "home"); // Lo mandamos al inicio
    }
}