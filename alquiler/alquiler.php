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
        <li class="nav-item">
            <a class="nav-link" href="../empresa/empresas.php">Empresas</a>
        </li>
        <li class="nav-pills">
            <a class="nav-link active" href="../alquiler/alquiler.php">Alquiler</a>
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
                        Insertar Alquiler
                    </div>
                    <div class="card-body">
                        <form action="insert_a.php" class="form-group" method="post">
                            <div class="form-group">
                                <label for="cedulacliente">Cédula del Cliente</label>
                                <select class="form-control" id="cedulacliente" name="cedulacliente">
                                    <option value="NULL" selected>Sin cliente</option>    
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
                                <label for="nitempresa">NIT de la empresa</label>
                                <select class="form-control" id="nitempresa" name="nitempresa">
                                    <option value="NULL" selected>Sin empresa</option>    
                                    <?php
                                        $empresas = consulta('SELECT nit FROM empresa');
                                        foreach ($empresas as $fila) {
                                            ?>
                                            <option> <?= $fila['nit']; ?> </option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="codigo">Codigo</label>
                                <input type="number" name="codigo" id="codigo" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="fechacompraalquiler">Fecha de compra de alquiler</label>
                                <input type="date" name="fechacompraalquiler" id="fechacompraalquiler" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="valoralquiler">Valor Alquiler</label>
                                <input type="number" name="valoralquiler" id="valoralquiler" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="direccion">Direccion</label>
                                <input type="text" name="direccion" id="direccion" class="form-control">
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
                            <th scope="col">Cédula del Cliente</th>
                            <th scope="col">NIT de la empresa</th>
                            <th scope="col">Codigo</th>
                            <th scope="col">Fecha de compra de alquiler</th>
                            <th scope="col">Valor alquiler</th>
                            <th scope="col">Dirección</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $date = consulta('SELECT DATE_FORMAT(fechacompraalquiler, "%d %M %Y") FROM alquiler');
                        $result = consulta('SELECT * FROM alquiler');
                        if($result){
                            foreach ($result as $fila){
                        ?>
                        <tr>
                            <td><?=$fila['cedulacliente'];?></td>
                            <td><?=$fila['nitempresa'];?></td>
                            <td><?=$fila['codigo'];?></td>
                            <td><?=$date['fechacompraalquiler'];?></td>
                            <td><?=$fila['valoralquiler'];?></td>
                            <td><?=$fila['direccion'];?></td>
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