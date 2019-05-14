<?php
require_once "Pasajero.php";
require_once "Vuelo.php";

$pasajero1 = new Pasajero("LOLO", "coco", "30887999", TRUE);
$pasajero=new Pasajero("LALA", "MAMA", "99999999", FALSE);
$pasajero2=new Pasajero("Mercedes", "Guerrero", "34152235", FALSE);

$vuelo1=new Vuelo("2 de enero","Aerolineas Argentinas",950,3);
$vuelo2 = new Vuelo("4 de julio","Norway Airlines",1180,5);


echo "<br><strong>Agregando pasajeros 1 2 y 3 al vuelo 1 (Buenos Aires - Bahía)....</strong><br>";
$vuelo1->AgregarPasajero($pasajero);
$vuelo1->AgregarPasajero($pasajero1);
$vuelo1->AgregarPasajero($pasajero2);
echo "<br><strong>Mostrar vuelo 1 (Buenos Aires - Bahía)</strong><br>";
$vuelo1->getVuelo();


/*
echo "<br>********************************************************************************************************";

Vuelo::MostrarVuelo($vuelo1);
echo "<br>********************************************************************************************************<br>";
echo "<br><strong>Eliminando del vuelo 1 al pasajero 3.</strong><br>";
Vuelo::Remove($vuelo1,$pasajero3);
echo "<br>********************************************************************************************************";
echo "<br><strong>Mostrar vuelo 1 (Buenos Aires - Bahía)</strong><br>";
Vuelo::MostrarVuelo($vuelo1);
echo "<br>********************************************************************************************************<br>";
echo "<br><strong>Eliminando del vuelo 1 al pasajero 2.</strong><br>";
Vuelo::Remove($vuelo1,$pasajero2);
echo "<br>********************************************************************************************************";
echo "<br><strong>Mostrar vuelo 1 (Buenos Aires - Bahía)</strong><br>";
Vuelo::MostrarVuelo($vuelo1);
echo "<br>********************************************************************************************************<br>";
echo "<br><strong>Agregando pasajero al vuelo 2 (Montevideo - Córdoba)....</strong><br>";
$vuelo2->AgregarPasajero($pasajero4);
if(!$vuelo2->AgregarPasajero($pasajero4)){
	echo "<br>1er pasajero: ";
	Pasajero::MostrarPasajero($pasajero4);echo "<br>";
	}else{
		echo "No se pudo<br>";
	}
echo "<br><strong>Recaudación total de los vuelos 1 y 2: $" . Vuelo::Add($vuelo1,$vuelo2) . "</strong></br>";
*/

?>