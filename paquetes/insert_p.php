<?php
require('../querybd.php');
$query="INSERT INTO paquete
	VALUES ($_POST[cedula_del_receptor],'$_POST[id]','$_POST[nivel_de_resistencia]','$_POST[peso]','$_POST[dimensiones]','$_POST[fecha_envio]')";
	echo $query;
$result = consulta($query);
if($result) {
	header ("Location: paquetes.php");
} else {
	echo "Ha ocurrido un error al crear la persona";
}
?>

