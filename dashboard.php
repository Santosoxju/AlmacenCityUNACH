<?php
	session_start();
	if (!isset($_SESSION['login']))
		header("location: index.php");	
?>
<html>
<head>
	<title>Sistema de Pruebas UNACH</title>
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/cerulean/bootstrap.min.css">
	<link href="css/cmce-styles.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
	<!-- Bootstrap core JavaScript -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>    
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<nav class="navbar "  style="margin-top:-56px; margin-bottom:-56px; height: 50px; background:#4461F2;" >
	<div class="container-fluid" >
    	<a class="navbar-brand" style="color:white; margin-top:-25px" >
		<b>Nombre de usuario:</b> <?php echo $_SESSION['nomusuario']; ?></a> 
		<a href="cerrar.php" style="margin-top:-10px" ><button class="button" style="background-color: #1E1E1E; color:white; width: 150px; height: 30px;">Cerrar Sesión</button></a>
  </div>
</nav>
<center>
	<br><br><br><br>
		
	<form action="dashboard.php" method="GET" >
	<div class="formpanel" id="f1">
		<b>Buscar producto por precio mayor a:</b> <input type="text" name="pre" size="4" style="width:100px; height:35px; " required>
		<button class="btn btn-info" style="border-radius:10px; width:100px; height:35px;" type="submit" >Buscar</button>
	</div>
	</form>
	

	<button type="button" class="btn " style="background-color:green; color:white; border-radius:10px; width:200px; height:35px;" data-bs-toggle="modal" data-bs-target="#exampleModal">
  		Nuevo Producto
	</button>

	<br><br>
	

	<?php
    include('conexion.php');
    $con = conectaDB();

    $sql = "SELECT idPro, Nombre, Precio, Ext FROM tb_productos";
    if (isset($_GET['pre'])) {
        $pre = (float)$_GET['pre']; // Asegúrate de que es un número
        $sql .= " WHERE Precio > $pre";
    }
    // aqui ago lo de editar producto
    echo "<table class='table' style='width:570px;'>"; // Ajustado con 'px'
    echo "<thead style='background-color: #1E1E1E; color:white;'>";
    echo "<th>Producto</th>";
    echo "<th>Precio</th>";
    echo "<th>Stock</th>";
    echo "<th>Acciones</th>";
    echo "</thead>";
    echo "<tbody>";
    
    $resultado = mysqli_query($con, $sql);  
    while ($fila = mysqli_fetch_row($resultado)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($fila[1]) . "</td>";
        echo "<td>" . htmlspecialchars($fila[2]) . "</td>";
        echo "<td>" . htmlspecialchars($fila[3]) . "</td>";
        echo "<td>

            <a href='#' class='edit-product' 
               data-id='" . htmlspecialchars($fila[0]) . "' 
               data-nombre='" . htmlspecialchars($fila[1]) . "' 
               data-precio='" . htmlspecialchars($fila[2]) . "' 
               data-existencia='" . htmlspecialchars($fila[3]) . "'>

               <img src='iconoeditar.png' width='25' height='25' title='Editar'>

            </a>
            <a href='#' onclick='confirmarEliminacion(" . htmlspecialchars($fila[0]) . ")'> 
                <img src='iconoeliminar.png' width='25' height='25' title='Eliminar'>
            </a>
        </td>";
        echo "</tr>";
    }
    echo "</tbody></table>";
	?>
	<br><br>
<!-- Modal Ventana de Nuevo Producto -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar nuevo producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Inputs para los datos del producto -->
                Descripcion del producto: <input class="form-control" type="text" name="txtDesc" id="txtDesc" required>
                Precio del producto: <input class="form-control" type="number" name="txtPrecio" id="txtPrecio" required>
                Stock: <input class="form-control" type="number" name="txtStock" id="txtStock" required>
            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col">
                        <button type="button" class="btn btn-danger" style="width:150px; height:35px;" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-success" style="width:150px; height:35px;" id="add-btn">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/insertarProducto.js"></script>
<script src="js/eliminarProducto.js"></script>
<script src="js/editarProducto.js"></script>

<!-- Modal para Editar Producto -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Encabezado del modal -->
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Editar Producto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Formulario de edición -->
            <form id="editProductForm" method="POST" action="controller/editarproducto.php">
                <div class="modal-body">
                    <!-- Campo oculto para el ID del producto -->
                    <input type="hidden" id="idProducto" name="id_producto">

                    <!-- Nombre del producto -->
                    <div class="mb-3">
                        <label for="nombreProducto" class="form-label">Nombre del producto:</label>
                        <input type="text" class="form-control" id="nombreProducto" name="nombreProducto" required>
                    </div>

                    <!-- Precio del producto -->
                    <div class="mb-3">
                        <label for="precioProducto" class="form-label">Precio del producto:</label>
                        <input type="number" class="form-control" id="precioProducto" name="precioProducto" required>
                    </div>

                    <!-- Existencia del producto -->
                    <div class="mb-3">
                        <label for="existenciaProducto" class="form-label">Existencia:</label>
                        <input type="number" class="form-control" id="existenciaProducto" name="existenciaProducto" required>
                    </div>
                </div>

                <!-- Footer del modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" style="width:150px; height:35px;" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success" style="width:150px; height:35px;" id="add-btn">Guardar Cambios</button>
                    
                </div>
            </form>
        </div>
    </div>
</div>



</center>

    <!-- Footer -->
    <footer class="footer" style="background:#1E1E1E;">
      <div class="container">
        <p class="m-0 text-center text-white" >UC: Desarrollo de aplicaciones web y móviles   |  Examen práctico 1 </p>
      </div>
    </footer>

	

</body>
</html>
