<?php

require_once 'auto.php';
require_once 'Garage.php';

echo "<br><br> <font size='5' color='red'  face='verdana'> TEST GARAGE <br></font>";

$auto1 = new Auto('Negro', 1000, 'Fiat', '2015');
$auto2 = new Auto('Azul', 1000, 'Ford', '2015');
$auto3 = new Auto('Negro', 2000, 'lolO', '2015');
$auto4 = new Auto('Negro', 3000, 'coco', '2015');
$auto5 = new Auto('Gris', 3000, 'Honda', '2005');

$garageNuevo = new Garage("Hola Hola", 40);

echo "AGREGADO DE AUTOS AL GARAGE Y MUESTRA";

$garageNuevo->Add($auto1);
$garageNuevo->Add($auto2);
$garageNuevo->Add($auto3);
$garageNuevo->Add($auto4);

$garageNuevo->MostrarGarage();

if ($garageNuevo->Equals($auto1)) {
    echo "<br>auto1 encontrado en el garage";
}

if ($garageNuevo->Equals($auto5)) {
    echo "<br>auto5 encontrado en el garage: SEE";
} else {

    echo "<br>auto5 encontrado en el garage: NOP";
}
echo "<br>remover 1";
$garageNuevo->Remove($auto1);
echo "<br>remover 5";
$garageNuevo->Remove($auto5);
echo "<br>remover 3";
$garageNuevo->Remove($auto3);

echo "<br>----------------MUUESTRA 2----------------";
$garageNuevo->MostrarGarage();
