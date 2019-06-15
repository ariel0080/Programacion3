<!-- 1- POST - > va al index HeladoCarga.php
se ingresa sabor precio tipo (crema o agua) cantidad de kg
se guardan los datos tomando el sabor y el tipo como identificador ( no se puede repetir)
---------------- se guarda en helados.txt (o csv)---------------- -->


<?php


if (isset($_POST["sabor"]) && isset($_POST["tipo"]) && isset($_POST["cantidad"]) && isset($_POST["precio"]) && isset($_FILES["foto"])) {
    echo "<font > <br>ALTA PIZZA CON FOTO<br> </font>";
    Pizzeria::agregarProducto($_POST["sabor"], $_POST["tipo"], $_POST["cantidad"], $_POST["precio"], $_FILES["foto"]);
} else if(isset($_POST["sabor"]) && isset($_POST["tipo"]) && isset($_POST["cantidad"]) && isset($_POST["precio"]))
{
echo "<font > <br>ALTA PIZZA SIN FOTO<br> </font>";
Pizzeria::agregarProducto( $_POST["sabor"],  $_POST["tipo"],  $_POST["cantidad"],  $_POST["precio"], null);
}
