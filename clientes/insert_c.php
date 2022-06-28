<?php
require('../querybd.php');
$query="INSERT INTO cliente
	VALUES ('$_POST[cedula]','$_POST[nombre]', '$_POST[username]', '$_POST[fechanacimiento]', '$_POST[sexo]','$_POST[paisorigen]','$_POST[celular]','$_POST[correo]','$_POST[contraseña]')";
$result = consulta($query);
if($result) {
	header ("Location: clientes.php");
} else {
	echo "Ha ocurrido un error al crear la persona";
}
?>