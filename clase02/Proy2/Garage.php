<?php

require 'auto.php';

class Garage
{
$precioPorHora;
$autos;
$razonSocial;

public function __construct($razon, $precio)
{
    $this->razonSocial= $razon;
    $this->precioPorHora = $precio;
    $this->autos = array();
}

function MostrarGarage()
{

        echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold'>
        <br> Garage <br> </font> Razon Social: " . $this->razonSocial.
        "<br> Precio: ". $this->precioPorHora;

}

function Equal ($garage, $auto)
{
    foreach ($garage as $autoIn)
    {
        if($autoIn->Equals($auto))
        {
            return true;
        }

    }

        return false;
}





?>