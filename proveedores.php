<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión Avícola</title>
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
    </div>
      <div class="main-content">
        <div class="header">
            <h1>Gestión Avícola</h1>
            <p>Toda la información de la granja al instante</p>
        </div>
            <div class="row">
            <div class="col-md-6">
                <h2>Registrar Proveedor</h2>
                <form id="providerForm">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del proveedor</label>
                        <input type="text" class="form-control" id="nombre" name="nombre">
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono">
                    </div>
                    <div class="mb-3">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion" name="direccion">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="productoscomprados" class="form-label">Productos comprados</label>
                        <input type="text" class="form-control" id="productoscomprados" name="productoscomprados">
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </form>
            </div>
            <div class="col-md-6">
                <h2>Lista de Proveedores</h2>
                <table class="table">
                    <thead class="bg-info">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Dirección</th>
                            <th scope="col">Correo Electrónico</th>
                            <th scope="col">Productos Comprados</th>
                        </tr>
                    </thead>
                    <tbody id="providersTable">
                        <!-- Datos de los proveedores se insertarán aquí -->
                    </tbody>
                </table>
            </div>
            <img src="logo.png" alt="Logo" class="logo" width="100">
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const providerForm = document.getElementById('providerForm');
            const providersTable = document.getElementById('providersTable');

            providerForm.addEventListener('submit', function (event) {
                event.preventDefault();

                const formData = new FormData(providerForm);
                const data = Object.fromEntries(formData.entries());

                fetch('/php/proveedores_db.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        alert(data.message);
                        loadProviders();
                    }
                })
                .catch(error => console.error('Error:', error));
            });

            function loadProviders() {
                fetch('/php/proveedores_db.php')
                    .then(response => response.json())
                    .then(data => {
                        providersTable.innerHTML = '';
                        data.forEach(provider => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td>${provider.id}</td>
                                <td>${provider.nombre}</td>
                                <td>${provider.telefono}</td>
                                <td>${provider.direccion}</td>
                                <td>${provider.email}</td>
                                <td>${provider.productoscomprados}</td>
                            `;
                            providersTable.appendChild(row);
                        });
                    })
                    .catch(error => console.error('Error:', error));
            }

            loadProviders();
        });
    </script>
</body>
</html>

