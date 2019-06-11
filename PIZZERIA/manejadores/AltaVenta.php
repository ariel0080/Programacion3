
<?php

echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold' <br>NUEVA VENTA POST SIN FOTO <br> </font>";

if (isset($_POST["sabor"]) && isset($_POST["tipo"]) && isset($_POST["cantidad"]) && isset($_POST["mail"])) {
    Pizzeria::nuevaVenta($_POST["sabor"], $_POST["tipo"], $_POST["cantidad"], $_POST["mail"],null);
}