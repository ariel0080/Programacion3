


<?php


parse_str(file_get_contents("php://input"), $_DELETE);

var_dump($_DELETE);
$_DELETE['cantidad'] = 0;
$_DELETE['precio'] = 0;

if(Pizzeria::modificarProducto($_DELETE, true))
{
    $sabor  = $_DELETE["sabor"];
    $tipo = $_DELETE["tipo"];
    $archivoOriginal=$sabor . $tipo . ".png";

    $destino = "./ImagenesDePizzas/".$archivoOriginal;
    
    $arrayDeDatos = explode('.', $archivoOriginal); //agarramos el archivo original y lo desarmamos
    $nuevoDestino = "./backUpFotos/" . $arrayDeDatos[0] . date("Y-m-d_h_m_s") . ".$arrayDeDatos[1]"; //hacemos un nuevo destino url con el nuevo nombre de archivo y la extension del original
    
    echo "NUEVO DESTINO $nuevoDestino";

    copy($destino, $nuevoDestino); //movemos ese archivo al nuevo destino

    unlink ($destino);
}








echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold' <br>MODIFICAR <br> </font>";
