<?php
class PlanView {

 public function showPlanes($planes) {
    // Esto apunta a: C:/xampp/htdocs/TpEspecialWeb2/App/templates/lista_planes.phtml
    require_once $_SERVER['DOCUMENT_ROOT'] . '/TpEspecialWeb2/App/templates/lista_planes.phtml';
}

public function showAddForm($clientes) {
   require_once $_SERVER['DOCUMENT_ROOT'] . '/TpEspecialWeb2/App/templates/form_alta_plan.phtml';
}
public function showPlanDetalle($plan) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/TpEspecialWeb2/App/templates/detalle_plan.phtml';
}

public function showEditForm($plan, $clientes) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/TpEspecialWeb2/App/templates/form_editar_plan.phtml';
}


 public function showPlanesPublic($planes) {
        
    require_once $_SERVER['DOCUMENT_ROOT'] . '/TpEspecialWeb2/App/templates/planesPublic.phtml'; 
}

}
