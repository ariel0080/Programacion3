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

$aux= $autoIgual1->getPrecio() + $autoIgual2->getPrecio();

echo "<br>la suma es : ".$aux;

echo "Comparar el primer 'Auto'​ con el segundo y quinto objeto e informar si son iguales o no";

echo ("<br>^^^^ Resultado del Agregado Precio Auto 1 y Auto 2: ".Auto::Add($autoIgual1, $autoIgual2)."<br>");

echo "Utilizar el método de clase “​ MostrarAuto​ ” para mostrar cada los objetos impares (1, 3, 5)";
$autoIgual1->MostrarAuto();
$autoIgual3->MostrarAuto();
$autoIgual5->MostrarAuto();
?>