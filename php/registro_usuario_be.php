<?php

include 'conexion_be.php';

$nombre_completo = $_POST["nombre_completo"];
$correo = $_POST['correo'];
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];


if (isset($_POST['correo'])) {
    // Acceder al valor de la clave 'correo'
    $correo = $_POST['correo'];
} else {
    // Si la clave 'correo' no está definida, manejar el error de alguna manera
    echo "La clave 'correo' no está definida en el array POST.";
}

$query = "INSERT INTO usuarios(nombre_completo, correo, usuario, contrasena) 
            VALUES('$nombre_completo', '$correo', '$usuario', '$contrasena')";


/* verificar que el correo no se repita*/

$verificar_correo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo' ");

if (mysqli_num_rows($verificar_correo) > 0) {
    echo '
                <script> 
                    alert("Este correo ya se encuentra registrado, prueba con otro");
                    window.location="../index.html";
                </script>
                ';
    exit();
}

/* verificar que el correo no se repita*/


$verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario='$usuario' ");

if (mysqli_num_rows($verificar_usuario) > 0) {
    echo '
                <script> 
                    alert("Este usuario ya se encuentra registrado, prueba con otro");
                    window.location="../index.html";
                </script>
                ';
    exit();
}

$ejecutar = mysqli_query($conexion, $query);

/* temporalmente, queda por colocar la pagina donde estara la barra*/

if ($ejecutar) {
    echo
    '<script>
        alert("Usuario almacenado exitosamente");
        window.location="../index.html";
    </script>';
} else {
    '<script>
        alert("Intentalo de nuevo, no hemos podido almacenar tu informacion");
        window.location="../index.html";
    </script>';
}

mysqli_close($conexion);
