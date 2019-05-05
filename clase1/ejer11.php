<?php
echo "<h2>Aplicación No 11 (Carga aleatoria) Imprima los valores del vector asociativo siguiente usando la estructura de control  </h2>";
// foreach​ $v[1]=90; $v[30]=7; $v['e']=99; $v['hola']= 'mundo';

$array = array(
   1      => 90,
   30     => 7,
   'e'    => 99,
   'hola' => 'mundo',
);

foreach ($array as $variable) 
{
	echo $variable."<br>";
}
