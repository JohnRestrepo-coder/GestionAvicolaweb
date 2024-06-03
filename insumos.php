<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Insumos - Gestión Avícola</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
        <button class="btn" onclick="location.href='menu.html'"><i class="fas fa-home"></i>Menú Inicial</button>
        <button class="btn" onclick="location.href='aves.html'"><i class="fas fa-drumstick-bite"></i>Aves</button>
        <button class="btn" onclick="location.href='produccion.html'"><i class="fas fa-egg"></i>Producción</button>
        <button class="btn" onclick="location.href='proveedores.html'"><i class="fas fa-truck"></i>Proveedores</button>
        <button class="btn" onclick="location.href='insumos.html'"><i class="fas fa-boxes"></i>Insumos</button>
    </div>
    <div class="main-content">
        <div class="header">
            <h1>Gestión Avícola</h1>
            <p><i>Toda la información de la granja al instante</i></p>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h2>Registro de Insumos</h2>
                <form id="registerForm">
                    <div class="mb-3">
                        <label for="nombre_insumo" class="form-label">Nombre del Insumo</label>
                        <input type="text" class="form-control" id="nombre_insumo" name="nombre_insumo" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_compra" class="form-label">Fecha de Compra</label>
                        <input type="date" class="form-control" id="fecha_compra" name="fecha_compra" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_vencimiento" class="form-label">Fecha de Vencimiento</label>
                        <input type="date" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" required>
                    </div>
                    <div class="mb-3">
                        <label for="cantidad_comprada" class="form-label">Cantidad Comprada</label>
                        <input type="number" class="form-control" id="cantidad_comprada" name="cantidad_comprada" required>
                    </div>
                    <div class="mb-3">
                        <label for="precio_unitario" class="form-label">Precio Unitario</label>
                        <input type="number" step="0.01" class="form-control" id="precio_unitario" name="precio_unitario" required>
                    </div>
                    <div class="mb-3">
                        <label for="estado_producto" class="form-label">Estado del Producto</label>
                        <select class="form-select" id="estado_producto" name="estado_producto" required>
                            <option value="Excelente">Excelente</option>
                            <option value="Bueno">Bueno</option>
                            <option value="Malo">Malo</option>
                            <option value="Vencido">Vencido</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </form>
            </div>
            <div class="col-md-6">
                <h2>Lista de Insumos Registrados</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Fecha de Compra</th>
                            <th>Fecha de Vencimiento</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Precio Total</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody id="insumosTableBody">
                        <!-- Los registros se cargarán aquí -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('registerForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(event.target);
            const data = Object.fromEntries(formData.entries());
            data.precio_total = (data.cantidad_comprada * data.precio_unitario).toFixed(2);
            fetch('php/insumos_db.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                if (result.message === "Insumo registrado correctamente") {
                    loadInsumos();
                } else {
                    alert(result.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });

        function loadInsumos() {
            fetch('php/insumos_db.php', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                const insumosTableBody = document.getElementById('insumosTableBody');
                insumosTableBody.innerHTML = '';
                data.forEach(insumo => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${insumo.nombre_insumo}</td>
                        <td>${insumo.fecha_compra}</td>
                        <td>${insumo.fecha_vencimiento}</td>
                        <td>${insumo.cantidad_comprada}</td>
                        <td>${insumo.precio_unitario}</td>
                        <td>${insumo.precio_total}</td>
                        <td>${insumo.estado_producto}</td>
                    `;
                    insumosTableBody.appendChild(row);
                });
            })
            .catch(error => console.error('Error:', error));
        }

        loadInsumos();
    </script>
</body>

</html>
