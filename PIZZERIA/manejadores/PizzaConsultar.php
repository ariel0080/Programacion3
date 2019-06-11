<?php

echo 
"<font> <br>CONSULTAR PIZZA <br> </font>";

if(isset($_POST["sabor"]) && isset($_POST["tipo"]) )
{    
    Pizzeria::consultarProducto($_POST["sabor"], $_POST["tipo"]);
}
