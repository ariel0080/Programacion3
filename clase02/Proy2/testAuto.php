<?php

require_once 'auto.php';

echo "<br><br> <font size='5' color='red'  face='verdana'> TEST AUTO <br></font>";

$autoIgual1 = new Auto('Negro', 1000, 'Fiat', '2015');

$autoIgual2 = new Auto('Azul', 1000, 'Ford', '2015');

$autoIgual3 = new Auto('Negro', 2000, 'Fiat', '2015');
$autoIgual4 = new Auto('Negro', 3000, 'Fiat', '2015');
$autoIgual5 = new Auto('Gris', 3000, 'Honda', '2005');
$autoIgual3->MostrarAuto();

$autoIgual3->AgregarImpuestos(1500);
$autoIgual4->AgregarImpuestos(1500);
$autoIgual5->AgregarImpuestos(1500);



echo ("<br>Agregado Precio Auto 1 y Auto 2: ".Auto::Add($autoIgual1, $autoIgual2));
 ?>