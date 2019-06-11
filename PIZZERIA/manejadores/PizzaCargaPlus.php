<?php


parse_str(file_get_contents("php://input"), $_PUT);

var_dump($_PUT);
    Pizzeria::modificarProducto($_PUT, false);
    echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold' <br>MODIFICAR <br> </font>";
