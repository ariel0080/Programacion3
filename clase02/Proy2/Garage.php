<?php
require_once 'auto.php';

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
        return in_array( $auto,$this->autos);
    }

    public function Add($autoAgregar)
    {
        if (in_array( $autoAgregar, $this->autos)) {
            echo "<br>----------------el auto ya se encuenta en el garage!<br>----------------";
        } else {
            array_push( $this->autos, $autoAgregar);
        }
    }

    public function Remove($autoQuita)
    {
        $esta = false;

        foreach ($this->autos as $key => $auto) {
            if (Auto::Equals($autoQuita, $auto) )
            {
                unset($this->autos[$key]);
                $esta = true;
            }
        }
        if (!$esta) {
            echo "<br>----------------el auto no se encuentra en el garage<br>----------------";
        }
    }
}

?>