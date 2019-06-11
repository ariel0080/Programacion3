<!-- 1- POST - > va al index HeladoCarga.php
se ingresa sabor precio tipo (crema o agua) cantidad de kg
se guardan los datos tomando el sabor y el tipo como identificador ( no se puede repetir)
---------------- se guarda en helados.txt (o csv)---------------- -->


<?php
echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold' <br>Alta PRODUCTO <br> </font>";
if (isset($_GET["sabor"]) && isset( $_GET ["tipo"] ) && isset( $_GET ["cantidad"]) && isset($_GET ["precio"]))
{
    Pizzeria::agregarProducto($_GET["sabor"], $_GET["tipo"], $_GET["cantidad"], $_GET["precio"], null);
}
