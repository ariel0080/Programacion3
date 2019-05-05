

<?php

echo "Aplicación No 9 (Carga aleatoria) Definir un Array de 5 elementos enteros y asignar a cada uno de ellos un número (utilizar la función ​ rand​ ). Mediante una estructura condicional, determinar si el promedio de los números son mayores, menores o iguales que 6. Mostrar un mensaje por pantalla informando el resultado.";





$array = array();

for ($i = 0; $i < 5; $i++) {

    $num_aleatorio = rand(1, 10);
    array_push($array, $num_aleatorio);
}

$acumulador = 0;

for ($i = 0; $i < 5; $i++) {
    $acumulador += $array[$i];
    print $acumulador . "<br>";
}

multiplo6($acumulador / 5);

?>


<?php

function multiplo6($valorAcumulado)
{

	print $valorAcumulado;
     print "<br>";

    switch ((int)$valorAcumulado) {



        case 0:
        case 1:
        case 2:
        case 3:
        case 4:
        case 5:
            print " MENOR QUE multiplo de 6";
            break;
        case 6:
            if($valorAcumulado==6)
            {
            	print " ES  multiplo de 6";
            	break;
            }
        case 7:
        case 8:
        case 9:
            print " MAYOR QUE multiplo de 6";
            break;
    }

}

?>