<!-- 4- post altaVentaConImagen.php
ALTA CON IMAGEN, guarda una imagen con la fecha de la venta
sabor y fecha. extension
carpeta /imagenDeLaVenta
guarda en venta.txt
 -->
 <?php



echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold' <br>NUEVA VENTA POST (con imagen) <br> </font>";

if (isset($_POST["sabor"]) && isset($_POST["tipo"]) && isset($_POST["cantidad"]) && isset($_POST["nombre"]) && isset  ($_FILES["foto"])) {
    Heladeria::nuevaVentaConfoto($_POST["sabor"], $_POST["tipo"], $_POST["cantidad"], $_POST["nombre"], $_FILES["foto"]);
}
else
{
    echo "nop";
}


