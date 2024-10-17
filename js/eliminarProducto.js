
function confirmarEliminacion(id) {
    if (confirm("¿Estás seguro de que deseas eliminar este producto?")) {
        // Si el usuario confirma, redirigimos a la página de eliminación
        window.location.href = 'controller/eliminarProducto.php?idp=' + id;
    }
}

