$(document).ready(function () {
    // Evento para abrir el modal y cargar los datos del producto
    $('.edit-product').on('click', function () {
        console.log('Modal abierto con éxito');

        // Obtiene los datos del producto desde los atributos del botón
        const idProducto = $(this).data('id'); 
        const nombreProducto = $(this).data('nombre');
        const precioProducto = $(this).data('precio');
        const existenciaProducto = $(this).data('existencia');

        // Llena los campos del modal con los valores obtenidos
        $('#idProducto').val(idProducto);
        $('#nombreProducto').val(nombreProducto);
        $('#precioProducto').val(precioProducto);
        $('#existenciaProducto').val(existenciaProducto);

        // Muestra el modal
        $('#editProductModal').modal('show');
    });

    // Evento para enviar el formulario de edición
    $('#editProductForm').on('submit', function (e) {
        e.preventDefault(); // Previene el envío del formulario tradicional

        // Recolecta los datos del formulario
        var idProducto = $('#idProducto').val();
        var nombreProducto = $('#nombreProducto').val();
        var precioProducto = $('#precioProducto').val();
        var existenciaProducto = $('#existenciaProducto').val();

        // Verifica que los campos no estén vacíos
        if (!nombreProducto || !precioProducto || !existenciaProducto) {
            alert("Por favor, completa todos los campos.");
            return; // Detener la ejecución si algún campo está vacío
        }

        $.ajax({
            url: 'controller/editarproducto.php', // Cambia esto por la ruta correcta a tu PHP
            method: 'POST',
            data: {
                idProducto: idProducto,
                nombreProducto: nombreProducto,
                precioProducto: precioProducto,
                existenciaProducto: existenciaProducto
            },
            success: function (data) {
                console.log("Respuesta del servidor:", data); // Mostrar la respuesta en la consola
                var jsonData;

                // Manejo de posibles errores al parsear la respuesta JSON
                try {
                    jsonData = JSON.parse(data);
                } catch (e) {
                    console.error("Error al parsear JSON:", e);
                    alert("Error al procesar la respuesta del servidor.");
                    return; // Detener si hay un error en el parseo
                }

                // Verifica si la edición fue exitosa
                if (jsonData.success == 1) {
                    alert(jsonData.message);
                    window.location = 'dashboard.php'; // Redirigir después de una edición exitosa
                } else {
                    alert(jsonData.message || "Ocurrió un error, inténtalo de nuevo.");
                }
            },
            error: function (xhr, status, error) {
                console.error("Error en la conexión al servidor:", error);
                alert("Error en la conexión al servidor. Por favor, verifica tu conexión.");
            }
        });
    });
});
