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
    <div class="main">
        <div class="header">
            <h1>Gestión Avícola</h1>
            <p>Toda la información de la granja al instante</p>
        </div>
        <div class="content">
            <h2>Resumen de la Granja</h2>
            <div class="summary">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total de Aves</h5>
                        <p class="card-text">5000</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Producción Mensual</h5>
                        <p class="card-text">15000 huevos</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Proveedores Activos</h5>
                        <p class="card-text">10</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Insumos Disponibles</h5>
                        <p class="card-text">200 kg de alimento</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
