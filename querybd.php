<?php
function consulta($query){
    require('configuraciones\conexion.php');
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    mysqli_close($conn);
    return $result;
}
?>