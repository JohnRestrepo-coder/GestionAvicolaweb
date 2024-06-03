<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

$hostname="localhost";
$username="id22080837_root";
$password="Restrepoap01*";
$dbname="id22080837_login_register_db";

$conexion = mysqli_connect($hostname, $username, $password, $dbname);

if ($conexion->connect_error) {
    die("Connection failed: " . $conexion->connect_error);
}

$request_method = $_SERVER["REQUEST_METHOD"];

switch($request_method) {
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        $nombre_insumo = $data['nombre_insumo'];
        $fecha_compra = $data['fecha_compra'];
        $fecha_vencimiento = $data['fecha_vencimiento'];
        $cantidad_comprada = (int)$data['cantidad_comprada'];
        $precio_unitario = (int)$data['precio_unitario'];
        $estado_producto = $data['estado_producto'];

        // Calcular el precio total
        $precio_total = $cantidad_comprada * $precio_unitario;

        $sql = "INSERT INTO insumos (nombre_insumo, fecha_compra, fecha_vencimiento, cantidad_comprada, precio_unitario, precio_total, estado_producto) VALUES ('$nombre_insumo', '$fecha_compra', '$fecha_vencimiento', $cantidad_comprada, $precio_unitario, $precio_total, '$estado_producto')";

        if ($conexion->query($sql) === TRUE) {
            echo json_encode(["message" => "Insumo registrado correctamente"]);
        } else {
            echo json_encode(["message" => "Error al registrar el insumo: " . $conexion->error]);
        }
        break;
    
    case 'GET':
        $sql = "SELECT * FROM insumos";
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

