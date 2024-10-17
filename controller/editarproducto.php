<?php
include('../conexion.php'); // Asegúrate de que la ruta es correcta
$link = conectaDB();

if (isset($_POST['idProducto'])) {    
    // Recupera los datos enviados desde el formulario
    $id_producto = $_POST['idProducto'];
    $nombre_producto = $_POST['nombreProducto'];
    $precio = $_POST['precioProducto'];
    $stock = $_POST['existenciaProducto'];
    
    // Prepara la consulta para evitar inyecciones SQL
    $query = "UPDATE tb_productos SET Nombre = ?, Precio = ?, Ext = ? WHERE idPro = ?";
    
    // Usa una declaración preparada para mayor seguridad
    if ($stmt = mysqli_prepare($link, $query)) {
        mysqli_stmt_bind_param($stmt, 'sdii', $nombre_producto, $precio, $stock, $id_producto);
        
        // Ejecuta la consulta
        if (mysqli_stmt_execute($stmt)) {
            // Respuesta exitosa en formato JSON
            echo json_encode(['success' => 1, 'message' => 'Producto editado exitosamente.']);
        } else {
            // Error al ejecutar la consulta
            echo json_encode(['success' => 0, 'message' => 'Error al ejecutar la consulta.']);
        }
        // Cierra la declaración
        mysqli_stmt_close($stmt);
    } else {
        echo json_encode(['success' => 0, 'message' => 'Error en la preparación de la consulta.']);
    }
    // Cierra la conexión
    mysqli_close($link);
} else {
    echo json_encode(['success' => 0, 'message' => 'Datos no válidos.']);
}
?>
