<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Avícola menu inicial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/346620edd7.js" crossorigin="anonymous"></script>
    <style>
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
        }

        .sidebar {
            width: 200px;
            background-color: rgba(247, 95, 34, 1);
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .sidebar button {
            display: flex;
            align-items: center;
            width: 100%;
            margin-bottom: 10px;
            background-color: white;
            color: black;
            border: none;
            padding: 10px;
            text-align: left;
            font-size: 16px;
            justify-content: flex-start;
        }

        .sidebar button i {
            margin-right: 10px;
        }

        .sidebar button:hover {
            background-color: #f1f1f1;
        }

        .main-content {
            flex-grow: 1;
            padding: 20px;
        }

        .header {
            background-color: rgba(247, 95, 34, 1);
            color: white;
            padding: 10px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <button class="btn" onclick="location.href='menuinicial.php'"><i class="fas fa-home"></i>Menú Inicial</button>
        <button class="btn" onclick="location.href='aves.php'"><i class="fas fa-dove"></i>Aves</button>
        <button class="btn" onclick="location.href='produccion.php'"><i class="fas fa-egg"></i>Producción</button>
        <button class="btn" onclick="location.href='proveedores.php'"><i class="fas fa-truck"></i>Proveedores</button>
        <button class="btn" onclick="location.href='insumos.php'"><i class="fas fa-boxes"></i>Insumos</button>
    </div>
    <div class="main-content">
        <div class="header">
            <h1>Gestión Avícola</h1>
            <p><i>Toda la información de la granja al instante</i></p>
        </div>
        <div class="container-fluid row">
            <form class="col-4 p-3" method="POST" action="php/registro_produccion.php">
                <h3 class="text-center text-secondary">Registro de la Producción de Huevos</h3>
                <?php
                include "php/conexion_be.php";
                ?>
                <div class="mb-3">
                    <label for="aves" class="form-label">Cantidad de Aves</label>
                    <input type="text" class="form-control" name="aves">
                </div>
                <div class="mb-3">
                    <label for="cantidad" class="form-label">Cantidad de Huevos Producidos</label>
                    <input type="text" class="form-control" name="cantidad">
                </div>
                <div class="mb-3">
                    <label for="preciounidad" class="form-label">Precio por Unidad</label>
                    <input type="text" class="form-control" name="preciounidad">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
                <button type="submit" class="btn btn-primary" name="btnregistrar" value="ok">Registrar</button>
            </form>
            <div class="col-8 p-4">
                <table class="table">
                    <thead class="bg-info">
                        <tr>
                            <th scope="col">Aves</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio Unidad</th>
                            <th scope="col">Ingresos Esperados</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                        include "php/conexion_be.php";
                        $sql = $conexion->query("SELECT * FROM productos");
                        while ($datos = $sql->fetch_object()) { ?>
                            <tr>
                                <td><?= $datos->Aves ?></td>
                                <td><?= $datos->Cantidad ?></td>
                                <td><?= $datos->Preciounidad ?></td>
                                <td><?= $datos->Ingresosesperados ?></td>
                                <td>
                                    <a href="" class="btn btn-small btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="" class="btn btn-small btn-danger"><i class="fa-solid fa-trash-arrow-up"></i></a>
                                </td>
                            </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>