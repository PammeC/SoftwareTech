<?php
class VentaDTO {
    private $idProducto;
    private $nombre;
    private $descripcion;
    private $cantidad;
    private $rutaImagen;
    private $precio;

    public function __construct($idProducto, $nombre, $descripcion, $cantidad, $rutaImagen, $precio) {
        $this->idProducto = $idProducto;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->cantidad = $cantidad;
        $this->rutaImagen = $rutaImagen;
        $this->precio = $precio;
    }

    // Getters y Setters
    
}
?>
