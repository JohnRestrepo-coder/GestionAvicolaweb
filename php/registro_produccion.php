<?php
include "conexion_be.php"; // Asegúrate de que la ruta sea correcta

if (!empty($_POST["btnregistrar"])) {
    if (
        !empty($_POST["aves"])
        && !empty($_POST["cantidad"])
        && !empty($_POST["preciounidad"])
    ) {
        echo "TODO OK";

        // Obtener los datos del formulario
        $aves = $_POST["aves"];
        $cantidad = $_POST["cantidad"];
        $preciounidad = $_POST["preciounidad"];

        // Insertar los datos en la tabla productos
        $sql = $conexion->query("INSERT INTO productos (Aves, Cantidad, Preciounidad) VALUES ('$aves', '$cantidad', '$preciounidad')");

        if ($sql) {
            echo '<div class="alert alert-success">Producto registrado correctamente</div>';
        } else {
            echo '<div class="alert alert-danger">Error al registrar el producto</div>';
        }
    } else {
        echo '<div class="alert alert-warning">Alguno de los campos está vacío</div>';
    }
}
?>
