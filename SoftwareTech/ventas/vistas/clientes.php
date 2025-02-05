<?php 
session_start();
if(isset($_SESSION['usuario'])){

	?>

	
	<!DOCTYPE html>
	<html>
	<head>
		<title>clientes</title>
		<?php require_once "menu.php"; ?>
	</head>
	<body>
		<div class="container">
			<h1>Clientes</h1>
			
			<div class="row">		
				<div class="col-sm-4">
					<form id="frmClientes">
						<label>Buscar Cliente</label>			
						<input type="text" class="form-control" id="buscarCedula" placeholder="Número de cédula">
						<p></p>
						<span class="btn btn-primary" id="btnBuscarCliente">Buscar</button></span>
						<span class="btn btn-primary" id="btnMostrarCliente">Mostrar Todos</button></span>
						<p></p>
						<label>Registrar un Nuevo Cliente</label>
						<p></p>	
						<label>Nombre</label>
						<input type="text" class="form-control input-sm" id="nombre" name="nombre">
						<label>Apellido</label>
						<input type="text" class="form-control input-sm" id="apellidos" name="apellidos">
						<label>Cedula</label>
						<input type="text" class="form-control input-sm" id="cedula" name="cedula">
						<label>Direccion</label>
						<input type="text" class="form-control input-sm" id="direccion" name="direccion">
						<label>Email</label>
						<input type="text" class="form-control input-sm" id="email" name="email">
						<label>Telefono</label>
						<input type="text" class="form-control input-sm" id="telefono" name="telefono">
						
						<p></p>
						<span class="btn btn-primary" id="btnAgregarCliente">Agregar</span>
					</form>
				</div>
				<div class="col-sm-8">
					<div id="tablaClientesLoad"></div>
				</div>
			</div>
		</div>

		<!-- Button trigger modal -->


		<!-- Modal -->
		<div class="modal fade" id="abremodalClientesUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualizar cliente</h4>
					</div>
					<div class="modal-body">
						<form id="frmClientesU">
							<input type="text" hidden="" id="idclienteU" name="idclienteU">
							<label>Nombre</label>
							<input type="text" class="form-control input-sm" id="nombreU" name="nombreU">
							<label>Apellido</label>
							<input type="text" class="form-control input-sm" id="apellidosU" name="apellidosU">
							<label>Cedula</label>
							<input type="text" class="form-control input-sm" id="cedulaU" name="cedulaU">
							<label>Direccion</label>
							<input type="text" class="form-control input-sm" id="direccionU" name="direccionU">
							<label>Email</label>
							<input type="text" class="form-control input-sm" id="emailU" name="emailU">
							<label>Telefono</label>
							<input type="text" class="form-control input-sm" id="telefonoU" name="telefonoU">							
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnAgregarClienteU" type="button" class="btn btn-primary" data-dismiss="modal">Actualizar</button>
					</div>
				</div>
			</div>
		</div>
	</body>
	</html>

	<script type="text/javascript">
		function agregaDatosCliente(idcliente){

			$.ajax({
				type:"POST",
				data:"idcliente=" + idcliente,
				url:"../procesos/clientes/obtenDatosCliente.php",
				success:function(r){
					dato=jQuery.parseJSON(r);
					$('#idclienteU').val(dato['id_cliente']);
					$('#nombreU').val(dato['nombre']);
					$('#apellidosU').val(dato['apellido']);
					$('#cedulaU').val(dato['cedula']);
					$('#direccionU').val(dato['direccion']);
					$('#emailU').val(dato['email']);
					$('#telefonoU').val(dato['telefono']);				
				}
			});
		}

		function eliminarCliente(idcliente){
			alertify.confirm('¿Desea eliminar este cliente?', function(){ 
				$.ajax({
					type:"POST",
					data:"idcliente=" + idcliente,
					url:"../procesos/clientes/eliminarCliente.php",
					success:function(r){
						if(r==1){
							$('#tablaClientesLoad').load("clientes/tablaClientes.php");
							alertify.success("Eliminado con exito!!");
						}else{
							alertify.error("No se pudo eliminar");
						}
					}
				});
			}, function(){ 
				alertify.error('Cancelo !')
			});
		}
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			
			$('#tablaClientesLoad').load("clientes/tablaClientes.php");
			
			$('#btnAgregarCliente').click(function(){
				try {
					// Validar que nombre y apellido no contengan números
					var nombre = $('#nombre').val();
					var apellido = $('#apellidos').val();
					if (/\d/.test(nombre) || /\d/.test(apellido)) {
						throw "El nombre y el apellido no deben contener números.";
					}
					
					// Validar cédula (10 dígitos y solo números)
					var cedula = $('#cedula').val();
					if (cedula.length !== 10 || isNaN(cedula)) {
						throw "La cédula debe tener 10 dígitos.";
					}

					// Validar email (debe contener @)
					var email = $('#email').val();
					if (!email.includes("@")) {
						throw "El email debe contener el formato '@examp.com'.";
					}

					// Validar teléfono (10 dígitos y solo números)
					var telefono = $('#telefono').val();
					if (telefono.length !== 10 || isNaN(telefono)) {
						throw "El teléfono debe tener 10 dígitos.";
					}

					
					
					// Si todas las validaciones pasan, proceder con el envío del formulario
					var datos=$('#frmClientes').serialize();

				
				vacios=validarFormVacio('frmClientes');
				
				if(vacios > 0){
					alertify.alert("Debes llenar todos los campos!");
					return false;
				}
				
				datos=$('#frmClientes').serialize();
				
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/clientes/agregaCliente.php",
					success:function(r){
						
						if(r==1){
							$('#frmClientes')[0].reset();
							$('#tablaClientesLoad').load("clientes/tablaClientes.php");
							alertify.success("Cliente agregado con exito");
						}else{
							alertify.error("No se pudo agregar cliente");
						}
					}
				});
			} catch (error) {
					alertify.error(error);
			}

			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnAgregarClienteU').click(function(){
				try {
					// Validar email en el formulario de actualización
					var emailU = $('#emailU').val();
					if (!emailU.includes("@")) {
						throw "El email debe contener '@'.";
					}

				datos=$('#frmClientesU').serialize();		
				
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/clientes/actualizaCliente.php",
					success:function(r){
						if(r==1){
							$('#frmClientes')[0].reset();
							$('#tablaClientesLoad').load("clientes/tablaClientes.php");
							alertify.success("Cliente actualizado con exito");
						}else{
							alertify.error("No se pudo actualizar cliente");
						}
					}
				});
			} catch (error) {
					alertify.error(error);
				}
			})
		})
	</script>

<script type="text/javascript">

	$('#btnMostrarCliente').click(function(){
			// Recargar la tabla con todos los clientes
			$('#tablaClientesLoad').load("clientes/tablaClientes.php");
			// Limpiar el campo de búsqueda
			$('#buscarCedula').val("");
    });

	// Nueva función para buscar cliente por cédula
    $('#btnBuscarCliente').click(function(){
        var cedula = $('#buscarCedula').val();

        if (cedula !== "") {
            $.ajax({
                type: "POST",
                data: { cedula: cedula },
                url: "clientes/tablaClientes.php",
                success: function(r){
                    if (r !== "0") {
                        // Mostrar los resultados de la búsqueda, por ejemplo, en una tabla
                        $('#tablaClientesLoad').html(r);
                    } else {
                        alertify.warning("Cliente no encontrado");
                    }
                }
            });
        } else {
            alertify.warning("Por favor, ingresa un número de cédula correcto");
        }
    });
</script>


	<?php 
}else{
	header("location:../index.php");
}
?>
