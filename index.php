<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Pruebas UNACH</title>
    <!-- Bootstrap core CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Custom styles -->
<link href="css/cmce-styles.css" rel="stylesheet">
<link href="css/stylesindex.css" rel="stylesheet">

</head>
<body>

    <div class="headtop">  	
        <p class="m-0 text-center text-white"> UNIDAD DE COMPETENCIA: <b> Desarrollo de Aplicaciones Web y Móviles</b></p>  	
    </div>

    <div class="container">
        <section id="signIn">
            <section class="ingresaDatos">
                <div class="row justify-content-center">
                    <div class="col-sm-12 col-md-5 col-lg-5">
                        <div class="card">
                            <div class="card-header">
                                Acceso de Usuarios
                            </div>
                            <div class="card-body">
                                <form id="loginForm">
                                    <div id="loginMessage"></div>
                                    <div class="form-group">
                                        <label for="loginUsername">Usuario</label>
                                        <input type="text" class="form-control" id="loginUsername" name="loginUsername" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="loginPassword">Contraseña</label>
                                        <input type="password" class="form-control" id="loginPassword" name="loginPassword" required>
                                    </div>
                                    <button type="button" id="btnSignIn" class="btn btn-primary">Iniciar sesión</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </div>

    <!-- Footer -->
    <footer class="footer bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white"><b> Dr. Christian Mauricio Castillo Estrada </b></p>
        </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/login.js"></script>  
    
</body>
</html>
