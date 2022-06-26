<!DOCTYPE html>
<html lang="en">
<head>
    <?php require('../querybd.php'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Paquetes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="../index.html">Inicio</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../clientes/clientes.php">Clientes</a>
        </li>
        <li class="nav-pills">
            <a class="nav-link active" href="../paquetes/paquetes.php">Paquetes</a>
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
                        Insertar paquete
                    </div>
                    <div class="card-body">
                        <form action="insert_p.php" class="form-group" method="post">
                            <div class="form-group">
                                <label for="cedula_del_receptor">Cédula del Receptor</label>
                                <select class="form-control" id="cedula_del_receptor" name="cedula_del_receptor">
                                    <option value="NULL" selected>Sin Receptor</option>    
                                    <?php
                                        $clientes = consulta('SELECT cedula FROM cliente');
                                        foreach ($clientes as $fila) {
                                            ?>
                                            <option> <?= $fila['cedula']; ?> </option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id">Id</label>
                                <input type="number" name="id" id="id" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="nivel_de_resistencia">Nivel de Resistencia</label>
                                <input type="number" name="nivel_de_resistencia" id="nivel_de_resistencia" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="peso">Peso</label>
                                <input type="number" name="peso" id="peso" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="dimensiones">Dimensiones</label>
                                <input type="text" name="dimensiones" id="dimensiones" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="fecha_envio">Fecha de envío</label>
                                <input type="date" name="fecha_envio" id="fecha_envio" class="form-control">
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
                            <th scope="col">Cédula del Receptor</th>
                            <th scope="col">Id</th>
                            <th scope="col">Nivel de resistencia</th>
                            <th scope="col">Peso</th>
                            <th scope="col">Dimensiones</th>
                            <th scope="col">Fecha de Envío</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $result = consulta('SELECT * FROM paquete');
                        if($result){
                            foreach ($result as $fila){
                        ?>
                        <tr>
                            <td><?=$fila['cedula_del_receptor'];?></td>
                            <td><?=$fila['id'];?></td>
                            <td><?=$fila['nivel_de_resistencia'];?></td>
                            <td><?=$fila['peso'];?></td>
                            <td><?=$fila['dimensiones'];?></td>
                            <td><?=$fila['fecha_envio'];?></td>
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