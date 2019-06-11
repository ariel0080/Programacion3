<!-- se ingresa tipo y sabor, si existe, devuele un “ si, hay!”
si no hay, pero hay el sabor y no el tipo, se avisa q hay sabor pero no tipo
---------------- se guarda en helados.txt (o csv)----------------
 -->

<?php

echo 
"<font> <br>CONSULTAR HELADO <br> </font>";

if(isset($_GET["sabor"]) && isset($_GET["tipo"]) )
{    
    Heladeria::consultarHelado($_GET["sabor"], $_GET["tipo"]);
}




/* $sabor = $_POST["sabor"];
$tipo = $_POST["tipo"];

$lista = Heladeria::LeerJSON("./archivos/helados.txt", "helado");
$helado = Heladeria::existeHelado($lista, $sabor, $tipo);

if ($helado->getSabor() == $sabor) {
    if ($helado->getTipo() == $tipo) {
        echo " hay sabor y tipo";
    } else {
        echo "hay sabor pero no tipo";
    }
} else {
    echo "no hay sabor";
}
*/
/* 
Heladeria::ListarTodo('helado'); 
*/
