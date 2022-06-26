<?php
require('../querybd.php');
$query="INSERT INTO cliente
	VALUES ('$_POST[cedula]','$_POST[nombre]','$_POST[apellido]','$_POST[sexo]','$_POST[telefono]','$_POST[correo]')";
$result = consulta($query);
if($result) {
	header ("Location: clientes.php");
} else {
	echo "Ha ocurrido un error al crear la persona";
}
?>