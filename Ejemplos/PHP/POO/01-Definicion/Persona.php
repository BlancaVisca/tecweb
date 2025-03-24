<?php
class Persona {
    private $nombre;

    // Método para inicializar el nombre
    public function inicializar($name) {
        $this->nombre = $name;  // Aquí se asigna el valor a la propiedad
    }

    // Método para mostrar el nombre
    public function mostrar() {
        echo '<p>' . $this->nombre . '</p>';
    }
}
?>
