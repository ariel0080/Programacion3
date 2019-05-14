<?php

class Vuelo
{

    private $fecha;
    private $empresa;
    private $precio;
    private $listadoPasajeros;
    private $cantMaxima;

    public function __construct($fech, $empre, $prec, $max)
    {
        $this->fecha = $fech;
        $this->empresa = $empre;
        $this->precio = $prec;
        $this->listadoPasajeros = array();
        $this->cantMaxima = $max;

    }

    public function getCantidadMaxima()
    {
        return $this->cantMaxima;
    }

    public function getVuelo()
    {
        $aux = "<font size='3' color='blue'  face='verdana' style='font-weight:bold'>
        <br> Pasajero  </font>
        <br> Fecha  " . $this->fecha .
        "<br> Empresa: " . $this->empresa .
        "<br> Precio" . $this->precio .
        "<br> Cantidad Maxima: " . $this->cantMaxima .
            "<br> Pasajeros: ";

        foreach ($this->listadoPasajeros as $pasajero) {
            $aux = $aux.Pasajero::MostrarPasajero($pasajero);
        }
        return $aux;
    }

    public function AgregarPasajero($pasajero)
    {
        if (!in_array($pasajero, $this->listadoPasajeros) && count($this->listadoPasajeros) < $this->cantMaxima) {
            array_push($this->listadoPasajeros, $pasajero);
            return true;
        } else {
            echo "<br>---------PASAJERO YA ENCONTRADI---------";
            return false;
        }
    }

}
