<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

$hostname="localhost";
$username="id22080837_root";
$password="Restrepoap01*";
$dbname="id22080837_login_register_db";
$usertable="proveedores";


 $conexion = mysqli_connect("localhost","id22080837_root", "Restrepoap01*", "id22080837_login_register_db"); 

if ($conexion->connect_error) {
    die("Connection failed: " . $conexion->connect_error);
}

$request_method = $_SERVER["REQUEST_METHOD"];

switch($request_method) {
    case 'POST':
        // Insert a new record
        $data = json_decode(file_get_contents('php://input'), true);
        $nombre = $data['nombre'];
        $telefono = $data['telefono'];
        $direccion = $data['direccion'];
        $email = $data['email'];
        $productoscomprados = $data['productoscomprados'];

        $sql = "INSERT INTO proveedores (nombre, telefono, direccion, email, productoscomprados) VALUES ('$nombre', '$telefono', '$direccion', '$email', '$productoscomprados')";

        if ($conexion->query($sql) === TRUE) {
            echo json_encode(["message" => "Proveedor registrado correctamente"]);
        } else {
            echo json_encode(["message" => "Error al registrar el proveedor: " . $conexion->error]);
        }
        break;
    
    case 'GET':
        // Retrieve records
        $sql = "SELECT * FROM proveedores";
        $result = $conexion->query($sql);
        $data = [];

        while($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        echo json_encode($data);
        break;

    default:
        echo json_encode(["message" => "Método no soportado"]);
        break;
}

$conexion->close();
?>

