<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Aves Gestión Avícola</title>
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
        <div class="row">
            <div class="col-md-6">
                <h2>Registro de Aves</h2>
                <form id="registerForm">
                    <div class="mb-3">
                        <label for="raza" class="form-label">Raza de la Gallina</label>
                        <select class="form-select" id="raza" name="raza" required>
                            <option value="Ponedora Isa Brown">Ponedora Isa Brown</option>
                            <option value="Ponedora Barrada">Ponedora Barrada</option>
                            <option value="Ponedora Blanca">Ponedora Blanca</option>
                            <option value="Ponedora Cuello Pelado">Ponedora Cuello Pelado</option>
                            <option value="Ponedora Negra">Ponedora Negra</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" class="form-control" id="cantidad" name="cantidad" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_ingreso" class="form-label">Fecha de Ingreso</label>
                        <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" required>
                    </div>
                    <div class="mb-3">
                        <label for="numero_lote" class="form-label">Número de Lote</label>
                        <input type="text" class="form-control" id="numero_lote" name="numero_lote" required>
                    </div>
                    <div class="mb-3">
                        <label for="sexo" class="form-label">Sexo</label>
                        <select class="form-select" id="sexo" name="sexo" required>
                            <option value="Macho">Macho</option>
                            <option value="Hembra">Hembra</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="peso_promedio" class="form-label">Peso Promedio (kg)</label>
                        <input type="number" step="0.01" class="form-control" id="peso_promedio" name="peso_promedio" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </form>
            </div>
            <div class="col-md-6">
                <h2>Lista de Aves Registradas</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Raza</th>
                            <th>Cantidad</th>
                            <th>Fecha de Ingreso</th>
                            <th>Número de Lote</th>
                            <th>Sexo</th>
                            <th>Peso Promedio</th>
                        </tr>
                    </thead>
                    <tbody id="avesTableBody">
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
            fetch('php/aves_db.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                if (result.message === "Ave registrada correctamente") {
                    loadAves();
                } else {
                    alert(result.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });

        function loadAves() {
            fetch('php/aves_db.php', {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                const avesTableBody = document.getElementById('avesTableBody');
                avesTableBody.innerHTML = '';
                data.forEach(ave => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${ave.raza}</td>
                        <td>${ave.cantidad}</td>
                        <td>${ave.fecha_ingreso}</td>
                        <td>${ave.numero_lote}</td>
                        <td>${ave.sexo}</td>
                        <td>${ave.peso_promedio}</td>
                    `;
                    avesTableBody.appendChild(row);
                });
            })
            .catch(error => console.error('Error:', error));
        }

        loadAves();
    </script>
</body>

</html>
