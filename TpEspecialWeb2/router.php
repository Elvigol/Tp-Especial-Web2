<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
session_start();
require_once 'config.php';
require_once 'app/controllers/planController.php';
require_once 'app/controllers/clienteController.php';
require_once 'app/controllers/authController.php';
require_once 'app/controllers/PlanPublicController.php';


define('BASE_URL','//'.$_SERVER['SERVER_NAME'] . ':' .$_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'home'; // Acción por defecto
if(!empty($_GET['action'])){
    $action = $_GET['action'];
}

$params = explode('/', $action);

// Tabla de ruteo 
switch ($params[0]) {
    
  case 'home':
    $controller = new PlanPublicController();
    $controller->showAllPlanes();
    break;
 case 'planes':
    $controller = new PlanPublicController();
    $controller->showAllPlanes();
    break;
        
    case 'plan':
        if (isset($params[1])) {
            $id = $params[1];
            // CORREGIDO: Llamado correcto instanciando el controlador
            $controller = new PlanController();
            $controller->showPlanById($id);
        } else {
            echo "Falta especificar el ID del plan.";
        }
        break;

    case 'cliente':
        if (isset($params[1])) {
            $id_cliente = $params[1];
            $controller = new PlanController();
            $controller->showPlanesByCliente($id_cliente);
        } else {
            echo "Falta especificar el ID del cliente.";
        }
        break;    
        
    case 'clientes':
        $controller = new ClienteController();
        $controller->showAllClientes();
        break;

    case 'nuevo-plan':
        $controller = new PlanController();
        $controller->showFormularioAlta();
        break;

    case 'add-plan':
        $controller = new PlanController();
        $controller->add();
        break;

    case 'editar-plan':
        if (isset($params[1])) {
            $controller = new PlanController();
            $controller->showFormularioEditar($params[1]);
        } else {
            echo "Falta especificar el ID del plan a editar.";
        }
        break;

    case 'update-plan':
        if (isset($params[1])) {
            $controller = new PlanController();
            $controller->update($params[1]);
        } else {
            echo "Falta el ID del plan para actualizar.";
        }
        break; 

    case 'eliminar-plan': 
        if (isset($params[1])) {
            $controller = new PlanController();
            $controller->delete($params[1]);
        } else {
            echo "Falta el ID del plan a eliminar.";
        }
        break;

    case 'login':
        $controller = new AuthController();
        $controller->showLogin();
        break;
        
    case 'verify':
        $controller = new AuthController();
        $controller->auth();
        break;
        
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;           
        
    case 'nuevo-cliente':
        $controller = new ClienteController();
        $controller->showFormularioAlta();
        break;

    case 'add-cliente':
        $controller = new ClienteController();
        $controller->add();
        break;

    case 'eliminar-cliente':
        if (isset($params[1])) {
            $controller = new ClienteController();
            $controller->delete($params[1]);
        } else {
            echo "Falta el ID del cliente a eliminar.";
        }
        break;

    case 'editar-cliente':
        if (isset($params[1])) {
            $controller = new ClienteController();
            $controller->showFormularioEditar($params[1]);
        } else {
            echo "Falta el ID del cliente a editar.";
        }
        break;

    case 'update-cliente':
        if (isset($params[1])) {
            $controller = new ClienteController();
            $controller->update($params[1]);
        } else {
            echo "Falta el ID del cliente a actualizar.";
        }
        break;        
        
    default:
        echo('404 Page not found');
        break;
}