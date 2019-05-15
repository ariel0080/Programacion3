<?php

require_once 'Vehiculo.php';
class Estacionamiento
{
    private $nombre;
    private $listaAutos;


    function __construct($nom)
    {
        $this->nombre = $nom;
        $this->listaAutos = array();
    }


    public static function Leer()
    {
        $listadoVehiculos = array();
        $archivo = fopen("estacionamiento.csv", "r");

        while (!feof($archivo)) {
            $renglon = fgets($archivo);

            $arrayDeDatos = explode(",", $renglon);

            $auto = new Vehiculo($arrayDeDatos[0], $arrayDeDatos[1], $arrayDeDatos[2]);

            array_push($listadoVehiculos, $auto);
        }

        fclose($archivo);
        return $listadoVehiculos;
    }

    
    public static function agregarVehiculosEstacionamiento($vehiculoAgregar)
    {
        $listadoVehiculos = array();
        $archivo = fopen("estacionamiento.csv", "w");

        $aux = implode(',', $vehiculoAgregar->toArray());

        fputs($archivo,  "\n".$aux);

        fclose($archivo);
        return $listadoVehiculos;
    }


    public function vehiculoEstacionado($patent)
    {
        $this->listaAutos = Estacionamiento::Leer();
        $esta= false;

        foreach ($this->listaAutos as $auto)
         {
            if ($auto->getPatente == $patent) 
            {

             } 
           
        }
        if (!esta)
        {
                $autoNuevo = new Vehiculo($patent, date("d/m/y"), 90);
                array_push($this->listaAutos, $autoNuevo);
                Estacionamiento::agregarVehiculosEstacionamiento($autoNuevo);
                echo "deberia haber grabado";
        }
    }
}
