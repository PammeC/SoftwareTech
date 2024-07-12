<?php 
	session_start();
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Ventas.php";
	$obj = new ventas();

	if (isset($_SESSION['tablaComprasTemp']) && is_array($_SESSION['tablaComprasTemp']) && count($_SESSION['tablaComprasTemp']) > 0) {
		$result = $obj->crearVenta();
		unset($_SESSION['tablaComprasTemp']);
		echo $result;
	} else {
		echo 0;
	}
?>

<?php
session_start();
require_once 'clases/factory/DAOFactory.php';

$daoFactory = DAOFactory::getDAOFactory('mysql'); // Cambia a 'postgresql' si quieres usar PostgreSQL
$compraDAO = $daoFactory->getCompraDAO();

if (isset($_SESSION['tablaCompras2Temp']) && is_array($_SESSION['tablaCompras2Temp']) && count($_SESSION['tablaCompras2Temp']) > 0) {
    $compraDTO = new CompraDTO(/* datos necesarios */);
    $result = $compraDAO->crearCompra($compraDTO);
    unset($_SESSION['tablaCompras2Temp']);
    echo $result;
} else {
    echo 0;
}
?>
