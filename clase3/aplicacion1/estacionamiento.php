<?php

require_once  'Vehiculo.php';

class Estacionamiento
{
    private $nombre;
    private $listaAutos;


    function __construct($nom)
    {
        $this->nombre = $nom;
        $this->listaAutos = array();
    }

/**
 */

    public static function LeerJSON()
    {
        $listadoVehiculos = array();
        $archivo = file_get_contents('estacionamiento.json');
      
            $json_data = json_decode($archivo,true);

            foreach ($json_data as $key => $value) 
            {              
                $auto = new Vehiculo( $json_data[$key]["patente"] , $json_data[$key]["fecha"], $json_data[$key]["precio"]);
                array_push($listadoVehiculos, $auto);
            }   
    

        return $listadoVehiculos;
    }
 /**    
 
 */

    public static function agregarVehiculosEstacionamientoJson($lista)
    {
        $listadoVehiculos = $lista;
        echo "agregarVehiculosEstacionamiento";
        $archivo = fopen("estacionamiento.json", "a");

        var_dump($listadoVehiculos);

        foreach ($listadoVehiculos as $key )
        {
            $array = array('patente' => $key->getPatente(), 'fecha' => date("d/m/y"),'precio' =>0);
            fputs($archivo,  json_encode($array, JSON_PRETTY_PRINT).',');
        }      

        fclose($archivo);
        return $listadoVehiculos;
    }

//////////////////////////////////////////////


public static function Leer()
{
    $listadoVehiculos = array();
    $archivo = fopen("estacionamiento.csv", "r");

    while (!feof($archivo))
    {
        $renglon = fgets($archivo);

        $arrayDeDatos = explode(",", $renglon);

        $auto = new Vehiculo($arrayDeDatos[0], $arrayDeDatos[1], $arrayDeDatos[2]);

        array_push($listadoVehiculos, $auto);

    }

    fclose($archivo);
    return $listadoVehiculos;
}

    public static function agregarVehiculosEstacionamiento($lista, $vehiculoAgregar)
    {
        $listadoVehiculos = $lista;
        echo "agregarVehiculosEstacionamiento";
        $archivo = fopen("estacionamiento.csv", "a+");

        $aux = implode(',', $vehiculoAgregar->toArray());

        fputs($archivo,  "\n" . $aux);

        fclose($archivo);
        return $listadoVehiculos;
    }


    public static function vehiculoEstacionado($patent)
    {
        $listadoVehiculo= Estacionamiento::LeerJSON();

        $auto = Estacionamiento::estaEstacionado($patent, $listadoVehiculo);

        if ($auto==null)
        {
            $autoNuevo = new Vehiculo($patent, date("d/m/y"), 0);
            array_push($listadoVehiculo, $autoNuevo);
            Estacionamiento::agregarVehiculosEstacionamiento($listadoVehiculo, $autoNuevo);
            Estacionamiento::agregarVehiculosEstacionamientoJson($listadoVehiculo);
            echo "deberia haber grabado";
        }


    }

    public static function estaEstacionado( $patent , $listadoVehiculo)
    {


        foreach ($listadoVehiculo as $auto)
        {
            if ($auto->getPatente() == $patent)
            {
                echo"Esta en el estacionamiento";
                return $auto;
                break;
             }
        }
        return null;
    }
}
