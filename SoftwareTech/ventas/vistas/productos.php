
<?php 
session_start();

// Recuperar los valores de la URL si están presentes
$totalRegistros = isset($_GET['totalRegistros']) ? $_GET['totalRegistros'] : 0;
$registrosPorPagina = isset($_GET['registrosPorPagina']) ? $_GET['registrosPorPagina'] : 10;

// Determinar la página actual
//$paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;


if(isset($_SESSION['usuario'])){
?>	
<!DOCTYPE html>
<html>
    <head>
        <title>productos</title>
        <?php require_once "menu.php"; ?>
        ?>
    </head>
    <body>
        <div class="container">
            <h1>Productos</h1>
            <div class="row">
                <div class="col-sm-4">												
                    <form id="frmArticulos" enctype="multipart/form-data">
                        
                        <label>Buscar Producto</label>			
                        <input type="text" class="form-control" id="buscarProducto" placeholder="Nombre del producto">
                        <p></p>
                        <span class="btn btn-primary" id="btnBuscarProducto">Buscar</button></span>
                        <span class="btn btn-primary" id="btnMostrarProducto">Mostrar Todos</button></span>
                        <p></p>

                        <label>Registrar un Nuevo Producto</label>
                        <p></p>

                       
                        <label>Nombre</label>
                        <input type="text" class="form-control input-sm" id="nombre" name="nombre">
                        <label>Descripcion</label>
                        <input type="text" class="form-control input-sm" id="descripcion" name="descripcion">
                        <label>Cantidad</label>
                        <input type="text" class="form-control input-sm" id="cantidad" name="cantidad">
                        <label>Precio</label>
                        <input type="text" class="form-control input-sm" id="precio" name="precio">
                        <label>Imagen</label>
                        <input type="file" id="imagen" name="imagen">
                        <p></p>
                        <span id="btnAgregaArticulo" class="btn btn-primary">Agregar</span>
                    </form>
                </div>					
                <div class="col-sm-8">
                    <span id="btnOrdenarCategoria" class="btn btn-primary">Ordenar por Categoria</span>
                    

                    <!-- Carga el formato de la página producto.php -->
<div id="formatoProducto"></div>

<script>
$(document).ready(function() {
    // Cargar el formato de la página producto.php al cargar la página
    $('#formatoProducto').load('vistas/producto.php');

    // Función para cargar la tabla de artículos al hacer clic en los enlaces de paginación
    $(document).on('click', '.pagination a', function(event) {
        event.preventDefault();
        var pagina = $(this).attr('href');
        $('#tablaArticulosLoad').load(pagina);
    });
});
</script>
    
    <div id="tablaArticulosLoad"></div>

    <!-- Aquí se mostrarán los enlaces de paginación 
    <?php 
    // Determina el número total de páginas
    $totalPaginas = ceil($totalRegistros / $registrosPorPagina);

    // Mostrar enlaces de paginación
    for ($i = 1; $i <= $totalPaginas; $i++) {
        echo "<a href='productos.php?pagina=$i'>$i</a> ";
    }
    ?>-->
</div>
</div>
</div>
        <!-- Button trigger modal -->
        <!-- Modal -->
        <div class="modal fade" id="abremodalUpdateArticulo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Actualiza Articulo</h4>
                    </div>
                    <div class="modal-body">
                        <form id="frmArticulosU" enctype="multipart/form-data">
                            <input type="text" id="idArticulo" hidden="" name="idArticulo">
                          
                            <label>Nombre</label>
                            <input type="text" class="form-control input-sm" id="nombreU" name="nombreU">
                            <label>Descripcion</label>
                            <input type="text" class="form-control input-sm" id="descripcionU" name="descripcionU">
                            <label>Cantidad</label>
                            <input type="text" class="form-control input-sm" id="cantidadU" name="cantidadU">
                            <label>Precio</label>
                            <input type="text" class="form-control input-sm" id="precioU" name="precioU">
                            
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button id="btnActualizaarticulo" type="button" class="btn btn-warning" data-dismiss="modal">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>

      
    </body>
</html>

<script type="text/javascript">
    function agregaDatosArticulo(idarticulo){
        $.ajax({
            type:"POST",
            data:"idart=" + idarticulo,
            url:"../procesos/articulos/obtenDatosArticulo.php",
            success:function(r){
                
                dato=jQuery.parseJSON(r);
                $('#idArticulo').val(dato['id_producto']);
                $('#nombreU').val(dato['nombre']);
                $('#descripcionU').val(dato['descripcion']);
                $('#cantidadU').val(dato['cantidad']);
                $('#precioU').val(dato['precio']);

            }
        });
    }

    function eliminaArticulo(idArticulo){
        alertify.confirm('¿Desea eliminar este articulo?', function(){ 
            $.ajax({
                type:"POST",
                data:"idarticulo=" + idArticulo,
                url:"../procesos/articulos/eliminarArticulo.php",
                success:function(r){
                    if(r==1){
                        $('#tablaArticulosLoad').load("articulos/tablaArticulos.php");
                        alertify.success("Eliminado con exito!");
                    }else{
                        alertify.error("No se pudo eliminar!");
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
		
        $('#btnActualizaarticulo').click(function(){

            datos=$('#frmArticulosU').serialize();
            $.ajax({
                type:"POST",
                data:datos,
                url:"../procesos/articulos/actualizaArticulos.php",
                success:function(r){
                    if(r==1){
                        $('#tablaArticulosLoad').load("articulos/tablaArticulos.php");
                        alertify.success("Actualizado con exito!");
                    }else{
                        alertify.error("Error al actualizar!");
                    }
                }
            });
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){

        $('#tablaArticulosLoad').load("articulos/tablaArticulos.php");

        $('#btnAgregaArticulo').click(function(){

            vacios=validarFormVacio('frmArticulos');

            if(vacios > 0){
                alertify.alert("Debes llenar todos los campos!");
                return false;
            }

            var formData = new FormData(document.getElementById("frmArticulos"));

            $.ajax({
                url: "../procesos/articulos/insertaArticulos.php",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,

                success:function(r){
                    
                    if(r == 1){
                        $('#frmArticulos')[0].reset();
                        $('#tablaArticulosLoad').load("articulos/tablaArticulos.php");
                        alertify.success("Agregado con exito!");
                    }else{
                        alertify.error("Fallo al subir el archivo!");
                    }
                }
            });
            
        });
    });
</script>


<script type="text/javascript">
    $(document).ready(function(){
        $('#btnBuscarProducto').click(function(){
            var nombreProducto = $('#buscarProducto').val();
            buscarProducto(nombreProducto);
        });
        $('#btnMostrarProducto').click(function(){
            mostrarTodosProductos();
        });

        function buscarProducto(nombreProducto){
            if (nombreProducto !== "") {
                $.ajax({
                    type:"POST",
                    data: { nombre: nombreProducto },
                    url:"articulos/tablaArticulos.php",
                    success:function(data){
                        $('#tablaArticulosLoad').html(data);
                    }
                });
            } else {				
                alertify.warning("Por favor, ingresa un Nombre de Producto correcto");
            }
        }

        function mostrarTodosProductos(){
            $.ajax({
                url:"articulos/tablaArticulos.php",
                success:function(data){
                    $('#tablaArticulosLoad').html(data);
                }
            });
        }
    });
</script>

<?php 
}else{
    header("location:../index.php");
}


?>
