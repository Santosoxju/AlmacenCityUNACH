<?php
function conectaDB() 
{ 
  	$host = 'localhost'; //url del webhost
	$user = 'root';  //nombre de Usuario que proporciona 000webhost
	$pass = '';

   if (!( $link = @mysqli_connect($host,$user,$pass)) )
   {
      echo "Error al realizar la conexión a la base de datos.";
      exit();
   }

   if (!mysqli_select_db($link,"miempresa")) //nombre de la BD que proporciona 000webhost
   { 
      echo "Error al seleccionar la base de datos."; 
      exit(); 
   }    
   return $link; 
} 
?>
