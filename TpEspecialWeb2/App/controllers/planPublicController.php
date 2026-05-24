<?php
class planPublicController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new PlanModel();
        $this->view = new PlanView();
    }

    public function showAllPlanes() {
        // Obtiene todos los planes del modelo
        $planes = $this->model->getAllPlanes();
        // Muestra la vista pública
        $this->view->showPlanesPublic($planes);
    }
}