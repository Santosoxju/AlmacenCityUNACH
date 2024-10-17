$(document).ready(function() {
    // Escucha el botón de inicio de sesión
    $('#btnSignIn').on('click', function() {
        login();
    });
});

// Función para iniciar sesión
function login() {
    var loginUsername = $('#loginUsername').val(); // Corregir el ID del input
    var loginPassword = $('#loginPassword').val(); // Corregir el ID del input

    $.ajax({
        url: 'controller/validar.php',
        method: 'POST', 
        data: {
            loginUsername: loginUsername,
            loginPassword: loginPassword,
        },
        success: function(data) {
            console.log("Respuesta cruda del servidor:", data); // Para depurar

            try {
                var jsonData = JSON.parse(data); // Intentar parsear el JSON

                if (jsonData.success == 1) {
                    alert("Has iniciado sesión con éxito");
                    window.location = 'dashboard.php';
                } else {
                    alert(jsonData.message || "Nombre de usuario y/o contraseña incorrectos");
                }
            } catch (error) {
                // Manejo del error al intentar parsear el JSON
                alert("Error al procesar la respuesta del servidor. Intente nuevamente.");
                console.error("Error al analizar JSON:", error);
                console.error("Respuesta recibida:", data);
            }
        },
        error: function(xhr, status, error) {
            alert("Error en el servidor: " + xhr.responseText);
        }
    });
}
