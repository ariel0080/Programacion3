
<?php

echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold' <br>NUEVA VENTA POST CON FOTO<br> </font>";

if (isset($_POST["sabor"]) && isset($_POST["tipo"]) && isset($_POST["cantidad"]) && isset($_POST["mail"]) && isset($_FILES["foto"])) 
{
    echo "entro";
    Pizzeria::nuevaVenta($_POST["sabor"], $_POST["tipo"], $_POST["cantidad"], $_POST["mail"], $_FILES["foto"]);
}