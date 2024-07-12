<?php
interface IVentaDAO {
    public function obtenDatosProducto($idProducto);
    public function creaFolio();
    public function crearVenta($ventaDTO);
    public function nombreProveedor($idProveedor);
    public function obtenerCantidadEnStock($idProducto);
    public function actualizarCantidadEnStock($idProducto, $nuevaCantidad);
    public function obtenerTotal($idVenta);
}
?>
