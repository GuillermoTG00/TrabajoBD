<!DOCTYPE html>
<html lang="en">
<head>
    <?php require('../querybd.php'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Empresa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="../index.html">Inicio</a>
        </li>
        <li class="nav-pills">
            <a class="nav-link" href="../clientes/clientes.php">Clientes</a>
        </li>
        <li class="nav-pills">
            <a class="nav-link active" href="../empresa/empresas.php">Empresas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../alquiler/alquiler.php">Alquiler</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../busquedas/busquedas.php">Consultas y Busquedas</a>
        </li>
    </ul>
    <div class="container mt-3">
        <div class="row">
            <div class="col-6 px-2">
                <div class="card">
                    <div class="card-header">
                        Insertar empresa
                    </div>
                    <div class="card-body">
                        <form action="insert_e.php" class="form-group" method="post">
                            <div class="form-group">
                                <label for="nit">NIT</label>
                                <input type="number" name="nit" id="nit" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" id="nombre" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="presupuesto">Presupuesto</label>
                                <input type="number" name="presupuesto" id="presupuesto" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="cedgerente">Cédula gerente</label>
                                <input type="number" name="cedgerente" id="cedgerente" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Insertar">
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-6 px-2">
                <table class="table border-rounded">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">NIT</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Presupuesto</th>
                            <th scope="col">Cédula gerente</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $result = consulta('SELECT * FROM empresa');
                        if($result){
                            foreach ($result as $fila){
                        ?>
                        <tr>
                            <td><?=$fila['nit'];?></td>
                            <td><?=$fila['nombre'];?></td>
                            <td><?=$fila['presupuesto'];?></td>
                            <td><?=$fila['cedgerente'];?></td>
                        </tr>
                        <?php
                            }
                        }
                            ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>