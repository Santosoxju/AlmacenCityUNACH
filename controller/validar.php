<?php
// Mostrar errores en pantalla (solo para depuración, eliminar en producción)
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../conexion.php');
$link = conectaDB();

// Comprobar si los datos están presentes
if (isset($_POST['loginUsername']) && isset($_POST['loginPassword'])) {
    $nomUser = $_POST['loginUsername'];
    $userPass = $_POST['loginPassword'];

      // Adaptación de la consulta SQL para usar la tabla y las columnas correctas
      $sql = "SELECT COUNT(*), NomUser FROM tb_usuarios WHERE NomUser ='$nomUser' AND Passwd ='$userPass'";
      $result = mysqli_query($link, $sql);
  
      $respuesta = 0;
      $nom_usr = "";
      while ($fila = mysqli_fetch_row($result)) {
          $respuesta = $fila[0];
          $nom_usr = $fila[1];    
      }
      if ($respuesta == 1 && $result == true) {
        session_start();
        $_SESSION['login'] = "true";
        $_SESSION['nomusuario'] = $nom_usr;
        echo json_encode(array('success' => 1)); // Asegúrate de que esto se devuelva correctamente
    } else {
        echo json_encode(array('success' => 0)); // Esto se envía cuando falla
    }

    mysqli_free_result($result);
    mysqli_close($link);
}  
?>