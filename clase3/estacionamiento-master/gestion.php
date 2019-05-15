<?php
require"clases/estacionamiento.php";

$patente=$_POST['patente'];
$accion=$_POST['estacionar'];

if($accion=="ingreso")
{

	estacionamiento::Guardar( $patente);
}
else
{
	estacionamiento::Sacar($patente);

		//var_dump($datos);
}

header("location:index.php");
?>
