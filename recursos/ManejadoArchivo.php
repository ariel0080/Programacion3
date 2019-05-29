
<?php

class ManejadorArchivo
{
	public static function moverArchivoBackup($archivoOriginal , $nuevoArchivo, $destino)
{
	$arrayDeDatos = explode('.', $archivoOriginal);
	$nuevoDestino = "../estacionamientov2/backup/" . $nuevoArchivo.date("Y-m-d_h_m_s").".$arrayDeDatos[1]";
	copy($destino, $nuevoDestino );

	$destino ="../estacionamientov2/".$nuevoArchivo.".$arrayDeDatos[1]";

	return TRUE;
}
}

?>