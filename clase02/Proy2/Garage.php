<?php

require 'auto.php';

class Garage
{
    private $precioPorHora;
    private $autos;
    private $razonSocial;

    public function __construct($razon, $precio)
    {
        $this->razonSocial = $razon;
        $this->precioPorHora = $precio;
        $this->autos = array();
    }

    public function MostrarGarage()
    {
        echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold'>
        <br> Garage <br> </font> Razon Social: " . $this->razonSocial .
        "<br> Precio: " . $this->precioPorHora;
        foreach ($this->autos as $auto) {
            $auto->MostrarAuto();
        }
    }

    public function Equals($auto)
    {
        return in_array($this->autos, $auto);
    }

    public function Add($autoAgregar)
    {
        if (in_array($this->autos, $autoAgregar)) {
            echo "<br>----------------el auto ya se encuenta en el garage!<br>----------------";
        } else {
            $this->autos->array_push($autoAgregar);
        }
    }

    public function Remove($autoQuita)
    {
        $esta = false;

        foreach ($this->autos as $auto) {
            if ($auto->Equals($autoQuita)) {
                unset($this->autos, $auto);
                $esta = true;
            }
        }
        if (!$esta) {
            echo "<br>----------------el auto no se encuentra en el garage<br>----------------";
        }
    }
}

?>