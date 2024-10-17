<?php
include('../conexion.php');
$link = conectaDB();

if (isset($_POST['txtDesc']) && isset($_POST['txtPrecio']) && isset($_POST['txtStock'])) {    

    $desc_producto = $_POST['txtDesc'];
    $precio = $_POST['txtPrecio'];
    $stock = $_POST['txtStock'];

    $query = "INSERT INTO tb_productos (Nombre, Precio, Ext) VALUES ('$desc_producto', $precio, $stock)";
    $result = mysqli_query($link, $query);

    if ($result) {
        echo json_encode(array('success' => 1)); 
    } else {
        echo json_encode(array('success' => 0, 'message' => 'Error: ' . mysqli_error($link))); 
    }

    mysqli_close($link);
}
?>
