
<?php

class ManejadorArchivo
{
	public static function moverArchivoBackup($archivoOriginal , $nuevoArchivo, $destino)
{
	$arrayDeDatos = explode('.', $archivoOriginal);
	$nuevoDestino = "backup/" . $nuevoArchivo.date("Y-m-d").".$arrayDeDatos[1]";
	copy($destino, $nuevoDestino );

	$destino ="archivos/".$_POST["nombre"].".$arrayDeDatos[1]";

	return TRUE;
}
}

?>