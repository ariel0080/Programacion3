


<?php

require_once 'contenedor.php';
require_once 'producto.php';

echo "<h3>Aplicaciones Nº 1 (producto conteiner) <br> Los containers puede ser (chico mediano o grande) con una capacidad de 1000kg o 2500kg o 9000kg <br> <br> los productos tiene un identificador unico de producto, el nombre, el importador, el pais de origen y los kilos <br> si el producto ya existe se suma los kilos</h3> ";

$container1 = new contenedor('grande');
//print_r($container1);

$producto1 = new producto();


$container1->agregarProducto($producto1);
//print_r($producto);


echo "<br><br><h2>Contenedor: </h2>";
$container1->mostrar();

 

//echo "<br><br><h2>Producto: </h2> ";
//$producto1->mostrar(); 



// crear objetos de producto y container

?>


