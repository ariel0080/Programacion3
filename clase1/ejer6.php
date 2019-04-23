<?php 

$op1 = $_GET["op1"];
$op2 = $_GET["op2"];
$operador = $_GET["operador"];

switch ($operador) {
	case "+":
 	print((int)$op1 + (int)$op2);		
		break;
case "-":
 	print((int)$op1 - (int)$op2);		
		break;
		case "*":
 	print((int)$op1 *(int)$op2);		
		break;
		case "/":
		if((int)$op2!=0)
		{
			print((int)$op1 /(int)$op2);	
		} 		
		break;	
	default:
	print((int)$op1 + (int)$op2);	
		break;
}



?>