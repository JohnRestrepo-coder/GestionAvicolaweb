<?php
    include 'conexion_be.php';
    $correo =$_POST['correo'];  //Captura el correo
    $contrasena=$_POST['contrasena'];   //captura la contrase


    $validar_login= mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo' and contrasena ='$contrasena'");
    if (mysqli_num_rows($validar_login)>0){
        echo '<script>window.location.href = "https://gestionavicola.000webhostapp.com/menuinicial.php";</script>';
        exit;
    }else{
        echo '
        <script>
        alert("Usuario o Contraseña incorrecta");
        window.location="https://gestionavicola.000webhostapp.com/";
        </script>';
        exit; 
    }
    

 ?> 