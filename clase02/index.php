


<?php

require_once 'contenedor.php';
require_once 'producto.php';

echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold'>Aplicaciones Nº 1 (producto conteiner) <br> Los containers puede ser (chico mediano o grande) con una capacidad de 1000kg o 2500kg o 9000kg <br>  <font  size='2' color='black'  face='verdana' > los productos tiene un identificador unico de producto, el nombre, el importador, el pais de origen y los kilos <br> si el producto ya existe se suma los kilos</font></font> ";

$container1 = new contenedor('grande');
//print_r($container1);

$producto1 = new producto("Coca Colaa", "001", "Importador 002", "Uruaguay", "200");
$producto3 = new producto("Coca Colaa", "001", "Importador 002", "Chile", "900");
$producto2 = new producto("Pepsi", "002", "Importador 002", "Uruaguay", "200");


//print_r($producto);
$container1->agregarProducto($producto1);
$container1->agregarProducto($producto2);
$container1->agregarProducto($producto3);


echo "<br><br><font size='5' color='red'  face='verdana'>Contenedor: </font
>";
$container1->mostrar();

 
//echo "<br><br><h2>Producto: </h2> ";
//$producto1->mostrar(); 
// crear objetos de producto y container

?>





