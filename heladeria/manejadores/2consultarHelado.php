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


