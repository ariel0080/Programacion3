<?php

require_once 'auto.php';

$autoIgual1 = new Auto('Negro', '1000', 'Fiat', '2015');
$autoIgual2 = new Auto('Negro', '1000', 'Fiat', '2015');

$autoIgual3 = new Auto('Negro', '2000', 'Fiat', '2015');
$autoIgual4 = new Auto('Negro', '3000', 'Fiat', '2015');

// Utilizar el método “AgregarImpuesto” en los últimos tres objetos,
// agregando $ 1500 al atributo precio.

$autoIgual3->MostrarAuto();

$autoIgual2->AgregarImpuesto('1500');
//$autoIgual3->AgregarImpuesto('1500');
//$autoIgual4->AgregarImpuesto('1500');

echo (Auto::Add($autoIgual1, $autoIgual2));


?>
