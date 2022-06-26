<!DOCTYPE html>
<html lang="en">
<head>
    <?php require('../querybd.php'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cliente</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="../index.html">Inicio</a>
        </li>
        <li class="nav-pills">
            <a class="nav-link active" href="../clientes/clientes.php">Clientes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../paquetes/paquetes.php">Paquetes</a>
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
                        Insertar cliente
                    </div>
                    <div class="card-body">
                        <form action="insert_c.php" class="form-group" method="post">
                            <div class="form-group">
                                <label for="cedula">Cédula</label>
                                <input type="number" name="cedula" id="cedula" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" id="nombre" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="apellido">Apellido</label>
                                <input type="text" name="apellido" id="apellido" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="sexo">Sexo: </label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sexo" id="M" value="M">
                                    <label class="form-check-label" for="M">Masculino</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sexo" id="F" value="F">
                                    <label class="form-check-label" for="F">Femenino</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input type="number" name="telefono" id="telefono" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="correo">Correo</label>
                                <input type="text" name="correo" id="correo" class="form-control">
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
                            <th scope="col">Cedula</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellido</th>
                            <th scope="col">Sexo</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Correo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $result = consulta('SELECT * FROM cliente');
                        if($result){
                            foreach ($result as $fila){
                        ?>
                        <tr>
                            <td><?=$fila['cedula'];?></td>
                            <td><?=$fila['nombre'];?></td>
                            <td><?=$fila['apellido'];?></td>
                            <td><?=$fila['sexo'];?></td>
                            <td><?=$fila['telefono'];?></td>
                            <td><?=$fila['correo'];?></td>
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