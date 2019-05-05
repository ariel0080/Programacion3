

<?php

echo "<h2> Generar una aplicación que permita cargar los primeros 10 números impares en un Array. Luego imprimir (utilizando la estructura ​ for​ ) cada uno en una línea distinta (recordar que el salto de línea en HTML es la etiqueta < br / >​). Repetir la impresión de los números utilizando las estructuras while​ y ​ foreach​ . </h2>";

$array = array();
$i     = 0;
$aux;

while ($i <= 10) {

    $aux = rand(0, 100);

    if ($aux % 2 != 0) {

        array_push($array, $aux);
       $i++;
    }

}

for ($i = 0; $i < 10; $i++) {

    print(($i+1)."º -".$array[$i]."<br>");

}

?>


