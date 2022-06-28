<?php
require('../querybd.php');
$query="INSERT INTO alquiler
	VALUES ($_POST[cedulacliente],'$_POST[nitempresa]','$_POST[codigo]','$_POST[fechacompraalquiler]','$_POST[valoralquiler]','$_POST[direccion]')";
	echo $query;
$result = consulta($query);
if($result) {
	header ("Location: alquiler.php");
} else {
	echo "Ha ocurrido un error al crear la persona";
}
?>