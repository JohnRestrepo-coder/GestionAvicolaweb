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
    die(json_encode(["message" => "Connection failed: " . $conexion->connect_error]));
}

$request_method = $_SERVER["REQUEST_METHOD"];

switch($request_method) {
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        $raza = $data['raza'];
        $cantidad = $data['cantidad'];
        $fecha_ingreso = $data['fecha_ingreso'];
        $numero_lote = $data['numero_lote'];
        $sexo = $data['sexo'];
        $peso_promedio = $data['peso_promedio'];

        $sql = "INSERT INTO aves (raza, cantidad, fecha_ingreso, numero_lote, sexo, peso_promedio) VALUES ('$raza', '$cantidad', '$fecha_ingreso', '$numero_lote', '$sexo', '$peso_promedio')";

        if ($conexion->query($sql) === TRUE) {
            echo json_encode(["message" => "Ave registrada correctamente"]);
        } else {
            echo json_encode(["message" => "Error al registrar el ave: " . $conexion->error]);
        }
        break;

    case 'GET':
        $sql = "SELECT * FROM aves";
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
