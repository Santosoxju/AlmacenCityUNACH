<?php
    include('../conexion.php');
    $link = conectaDB();

    if (isset($_GET['idp']) && is_numeric($_GET['idp'])) {	
        $idp = $_GET['idp']; // Declaro variable con el valor obtenido

        // Cambié el nombre de la tabla y la columna
        $sql = "DELETE FROM tb_productos WHERE idPro = $idp";

        $result = mysqli_query($link, $sql);

        if ($result) {
            header("Location: ../dashboard.php");
        } else {
            echo "<script> alert('Algo salió mal, intentalo de nuevo'); </script>";
        }

        // No es necesario liberar resultados aquí porque no estamos haciendo una consulta SELECT
        mysqli_close($link);
    }
?>
