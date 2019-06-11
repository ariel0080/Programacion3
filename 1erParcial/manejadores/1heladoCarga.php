<!-- 1- POST - > va al index HeladoCarga.php
se ingresa sabor precio tipo (crema o agua) cantidad de kg
se guardan los datos tomando el sabor y el tipo como identificador ( no se puede repetir)
---------------- se guarda en helados.txt (o csv)---------------- -->


<?php
echo "<font > <br>Alta de Auto por POST SIN FOTO <br> </font>";

if (isset($_POST["sabor"]) && isset( $_POST ["tipo"] ) && isset( $_POST ["cantidad"]) && isset($_POST ["precio"]))
{
    Heladeria::agregarProducto($_POST["sabor"], $_POST["tipo"], $_POST["cantidad"], $_POST["precio"],null);
}

