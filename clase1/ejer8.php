<?php
/*
REQUI RE_once "ejer5.php";
echo "<br>".$a;
*/
$num = $_GET["numero"];


echo "Aplicación No 8 <br><br><br>(Números en letras) Realizar un programa que en base al valor numérico de la variable, pueda mostrarse por pantalla, el nombre del número que tenga dentro escrito con palabras, para los números entre el 20 y el 60. Por ejemplo, si $num = 43 debe mostrarse por pantalla “cuarenta y tres";
 
//http://localhost/Programacion3/clase1/ejer8.php?numero=25

print ("<br>su numero es: ".$num."<br><br><br>");

if( $num <20 || $num >60)
{
	print "numero incorrecto";
}

else
{

switch (substr($num, 0,1))
		 {
			case 5:
					$num-=50;
					numero0a9($num , "ciencuenta y ", "cincuentaa");
				break;
			case 4:
					$num-=40;
					numero0a9($num , "cuarenta y ", "cuarenta");
				break;

			case 3:
					$num-=30;
					numero0a9($num , "treinta y ", "treinta");

			case 2:
					$num-=20;
					numero0a9($num , "Veinti", "veinte");

		}
		
	}

?>

<?php 


function numero0a9 ($numero , $texto, $cero)
{
	switch($numero)
	{
		case 1:
		print ($texto."uno");
		break;
		
		case 2:
		print ($texto."dos");
		break;

		case 3:
		print ($texto."tres");
		break;
		
		case 4:
		print ($texto."cuatro");
		break;

		case 5:
		print ($texto."cinco");
		break;
		
		case 6:
		print ($texto."seis");
		break;

		case 7:
		print ($texto."siete");
		break;
		
		case 8:
		print ($texto."ocho");
		break;

		case 9:
		print ($texto."nueve");
		break;
		
		case 0:
		print ($cero);
		break;
		

		}
}

 ?>

