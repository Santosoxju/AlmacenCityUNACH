$(document).ready(function() {
    $('#add-btn').on('click', function() {
        insertProduct();
    });
});

// Función para insertar un producto
function insertProduct() {
    var txtDesc = $('#txtDesc').val();
    var txtPrecio = $('#txtPrecio').val();
    var txtStock = $('#txtStock').val();

    // Verifica que los campos no estén vacíos
    if (!txtDesc || !txtPrecio || !txtStock) {
        alert("Por favor, completa todos los campos.");
        return; // Detener la ejecución si algún campo está vacío
    }

    $.ajax({
        url: 'controller/insertarProducto.php',
        method: 'POST',
        data: {
            txtDesc: txtDesc,
            txtPrecio: txtPrecio,
            txtStock: txtStock
        },
        success: function(data) {
    console.log("Respuesta del servidor:", data); // Agrega esto para ver la respuesta cruda
    var jsonData;
    
    try {
        jsonData = JSON.parse(data);
    } catch (e) {
        console.error("Error al parsear JSON:", e);
        alert("Error al procesar la respuesta del servidor.");
        return; // Termina si hay un error al parsear
    }

    if (jsonData.success == 1) {
        alert("Producto agregado exitosamente.");
        window.location = 'dashboard.php'; // Redirigir después de una inserción exitosa
    } else {
        alert(jsonData.message || "Ocurrió un error, inténtalo de nuevo.");
    }
},

    });
}
