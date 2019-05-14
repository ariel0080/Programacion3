<?php

require_once "Vehiculo.php";
$vehiculoNuevo= new  Vehiculo("fcc807", "201", 1500);

$vehiculoNuevo::guardar($vehiculoNuevo);
