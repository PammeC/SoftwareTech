<?php 
	session_start();
	$iduser=$_SESSION['iduser'];
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Articulos.php";

	$obj= new articulos();

	$datos=array();
	
	$nombreImg=$_FILES['imagen']['name'];
	$rutaAlmacenamiento=$_FILES['imagen']['tmp_name'];
	$carpeta='../../archivos/';
	$rutaFinal=$carpeta.$nombreImg;



		if(move_uploaded_file($rutaAlmacenamiento, $rutaFinal)){
				$idimagen=$obj->agregaImagen($datosImg);

				if($idimagen > 0){

					$datos[0]=$idimagen;
					$datos[1]=$iduser;
					$datos[2]=$_POST['nombre'];
					$datos[3]=$_POST['descripcion'];
					$datos[4]=$_POST['cantidad'];
					$datos[5]=$_POST['precio'];
					echo $obj->insertaArticulo($datos);
				}else{
					echo 0;
				}
		}

 ?>