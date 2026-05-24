<?php
class ErrorView {
    public function renderError($mensaje) {
    
        echo "<div style='background: #ffcccc; color: red; padding: 15px; text-align: center; font-weight: bold;'>";
        echo "<h2>Error</h2>";
        echo "<p>$mensaje</p>";
        echo "<a href='" . BASE_URL . "planes'>Volver al inicio</a>";
        echo "</div>";
        die();
    }
}