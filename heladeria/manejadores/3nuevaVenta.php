<!-- 3- POST ->altaVenta tipo, sabo, kg
si hay pero no alcanza aviso cuanto hay
si hay guardar en venta.txt y descontar de helado.txt el stock
en ventas guarda todos lo datos
precio final
precio por kg
PRECIO FIJO ?
guarda en venta.txts -->

<?php

echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold' <br>NUEVA VENTA POST SIN FOTO <br> </font>";

if (isset($_POST["sabor"]) && isset($_POST["tipo"]) && isset($_POST["cantidad"]) && isset($_POST["nombre"])) {
    Heladeria::nuevaVenta($_POST["sabor"], $_POST["tipo"], $_POST["cantidad"], $_POST["nombre"],null);
}

