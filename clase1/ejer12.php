<?php

echo " Realizar las líneas de código necesarias para generar un Array asociativo $lapicera, que contenga como elementos: ‘​ color’​ , ‘​ marca’​ , ‘​ trazo’​ y ‘​ precio’​ . Crear, cargar y mostrar tres lapiceras. ";

$lapiceras = array(
    "Lapicera 1" => array(
        "color" => "Verde",
        "marca"  => "Marca1",
        "trazo"  => "fino",
        "precio" => "$50"),
    "Lapicera 2" => array(
        "color"  => "Azul",
        "marca"  => "Marca2",
        "trazo"  => "Ulta fino",
        "precio" => "$80"),
    "Lapicera 3" => array(
        "color"  => "Rojo",
        "marca"  => "Marca4",
        "trazo"  => "grueso",
        "precio" => "$150"),
);

foreach ($lapiceras as $key => $lapicera) {
    echo "<br><br>" . $key . ":" . "Color " . $lapicera['color'] . ";";
    echo "<br>" . $key . ":" . "Marca " . $lapicera['marca'] . ";";
    echo "<br>" . $key . ":" . "Trazo " . $lapicera['trazo'] . ";";
    echo "<br>" . $key . ":" . "Precio " . $lapicera['precio'] . ";";
}
