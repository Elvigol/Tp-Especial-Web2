<?php

class AuthView {
   public function showLogin($error = null) {
    require_once dirname(__FILE__, 2) . '/templates/form_login.phtml';
}
}