<?php

class ClienteView {
    
  
    public function showClientes($clientes) {
        
       require_once $_SERVER['DOCUMENT_ROOT'] . '/TpEspecialWeb2/App/templates/lista_clientes.phtml';
    }

    public function showAddForm() {
       
         require_once $_SERVER['DOCUMENT_ROOT'] . '/TpEspecialWeb2/App/templates/form_alta_cliente.phtml';
    }

  
    public function showEditForm($cliente) {
       require_once $_SERVER['DOCUMENT_ROOT'] . '/TpEspecialWeb2/App/templates/form_editar_cliente.phtml';
    }
}