<!DOCTYPE html>
<html lang="en">
<head>
    <?php require('../querybd.php'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Consultas y Busquedas</title>
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
        <li class="nav-item">
            <a class="nav-link" href="../alquiler/alquiler.php">Alquiler</a>
        </li>
        <li class="nav-pills">
            <a class="nav-link active" href="../busquedas/busquedas.php">Consultas y Busquedas</a>
        </li>
    </ul>
    <div class="container mt-3">
        <form method="post" class="py-3 d-flex justify-content-around align-items-start">
                <input type="submit"
                    name="consulta"
                    class="btn btn-info"
                    value="CONSULTA 1">
                <input type="submit"
                    name="consulta"
                    class="btn btn-warning"
                    value="CONSULTA 2">
                <div>
                    <input type="submit"
                        name="busqueda"
                        class="btn btn-primary"
                        value="BUSQUEDA 1">
                    <div class="form-group">
                        <label for="numero1">Número 1</label>
                        <input type="number" name="numero1" id="numero1" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="numero2">Número 2</label>
                        <input type="number" name="numero2" id="numero2" class="form-control">
                    </div>
                </div>                
                <div>
                    <input type="submit"
                        name="busqueda"
                        class="btn btn-danger"
                        value="BUSQUEDA 2">
                    <div class="form-group">
                        <label for="finicio">Fecha inicio</label>
                        <input type="date" name="finicio" id="finicio" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="ffin">Fecha fin</label>
                        <input type="date" name="ffin" id="ffin" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="numero1fec">Número 1</label>
                        <input type="number" name="numero1fec" id="numero1fec" class="form-control">
                    </div>
                </div>
        </form>
        <?php
        if ($_POST) {
            if (isset($_POST["consulta"])) {
                $query = [
                    "CONSULTA 1" => "SELECT cedula, nombre
                                    FROM alquiler
                                    JOIN cliente ON cedula = cedulacliente
                                    GROUP BY cedula, nombre
                                    HAVING SUM(valoralquiler) > 1000 AND COUNT(cedulacliente) >= 3 AND COUNT(NULLIF(nitempresa, 0)) = 0",
                    "CONSULTA 2" => "SELECT codigo, valoralquiler AS valorAlquiler
                                    FROM alquiler
                                    JOIN empresa ON nit = nitempresa
                                    WHERE valorAlquiler > presupuesto AND cedulacliente = cedgerente"
                ][$_POST["consulta"]];
            } elseif ($_POST["busqueda"] && $_POST["numero1"] && $_POST["numero2"]) {
                $query = "SELECT nit, nombre FROM alquiler
                        JOIN empresa ON nit = nitempresa
                        GROUP BY nitempresa, nombre
                        HAVING COUNT(nitempresa) >= $_POST[numero1] AND COUNT(nitempresa) <= $_POST[numero2]";
            } elseif ($_POST["busqueda"] && $_POST["finicio"] && $_POST["ffin"] && $_POST["numero1fec"]) {
                $query = "SELECT cedula, celular FROM cliente
                        JOIN alquiler ON cedula = cedulacliente
                        WHERE fechacompraalquiler BETWEEN '$_POST[finicio]' AND '$_POST[ffin]'
                        GROUP BY cedulacliente, celular
                        HAVING COUNT(cedulacliente) = '$_POST[numero1fec]'";
            } else {
                $query = "SELECT 'Algo salió mal' AS error FROM dual";
            }
            $result = consulta($query);
        ?>
        <div class="row">
            <div class="col-12">
                <table class="table border-rounded">
                    <thead class="thead-dark">
                    <tr>
                        <?php
                            $fields = array_keys(mysqli_fetch_assoc($result));
                            foreach ($fields as $name) {
                                echo "<th scope='col'>".str_replace("_", " ", ucfirst($name))."</th>";
                            }
                        ?>
                    </tr>
                    </thead>
                    <tbody>       
                        <?php
                            foreach($result as $row) {
                                echo "<tr>";
                                foreach($row as $value) {
                                    echo "<td>".$value."</td>";
                                }
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
        <?php
        }
        ?>
    </div>
</body>
</html>