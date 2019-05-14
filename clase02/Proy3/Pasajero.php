<?php

class Pasajero
{

    private $apellido;
    private $nombre;
    private $dni;
    private $esPlus;

    public function __construct($ape = "LOLO", $nom = "coco", $dn = "7777", $esP = true)
    {
        $this->apellido = $ape;
        $this->nombre = $nom;
        $this->dni = $dn;
        $this->esPlus = $esP;

    }

    private function getPasajeroInfo()
    {
        $aux = "<font size='3' color='blue'  face='verdana' style='font-weight:bold'>
        <br> Pasajero  </font>
        <br> Nombre y Apellido:  " . $this->nombre . " " . $this->apellido .
        "<br> DNI: " . $this->dni;

        if ($this->esPlus == 1) {
            $aux = $aux."<br> EsPlus : SI";
        } else {
            $aux = $aux."<br> EsPlus : NO";
        }
        return $aux;


    }

    public static function MostrarPasajero($pasajero)
    {
        echo "<br>". $pasajero->getPasajeroInfo();
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
