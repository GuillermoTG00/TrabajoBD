<?php
require('../querybd.php');
$query="INSERT INTO empresa
	VALUES ('$_POST[nit]','$_POST[nombre]','$_POST[presupuesto]')";
$result = consulta($query);
if($result) {
	header ("Location: empresas.php");
} else {
	echo "Ha ocurrido un error al crear la empresa";
}
?>