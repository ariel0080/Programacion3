<?php 
$a = 6;
$c = 8;
$b = 8;

if($a>(int)$b && $a<(int) $c)
 {
 	print($a);
 }

else if($b>(int)$a && $b<(int) $c)
 {
 	print($b);
 }
 else if($c>(int)$a && $c< (int)$b)
 {
 	print($c);
 }
 else 
 {
 	print("todos putes + NO HAY VALOR MEDIO");
 }

?>