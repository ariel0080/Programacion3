<?php

require_once "Vehiculo.php";
$listado = Vehiculo::Leer();

foreach ($listado as $auto)
{
    $auto->MostrarAuto();
    echo "<br>---------<br>";
}
