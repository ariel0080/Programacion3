<?php

class Pasajero
{

    private $apellido;
    private $nombre;
    private $dni;
    private $esPlus;

    public function __constructor($ape, $nom, $dn, $esP)
    {
        $this->apellido = $ape;
        $this->nombre = $nom;
        $this->dni = $dn;
        $this->esPlus = $esP;
    }

    private function getPasajeroInfo()
    {
        return "<font size='3' color='blue'  face='verdana' style='font-weight:bold'>
        <br> Pasajero  </font>
        <br> Nombre y Apellido:  " . $this->nombre . " " . $this->apellido .
        "<br> DNI: " . $this->dni .
        "<br> EsPlus " . $this->esPlus;
    }

    public static function MostrarPasajero($pasajero)
    {
        echo "Pasajero: ".$pasajero->getPasajeroInfo();
    }

    public function Equals($pasajero2)
    {
        if ($this->dni == $pasajero2->dni) {
            return true;
        } else {
            return false;
        }
    }

}
