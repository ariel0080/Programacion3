<?php

require_once  'Vehiculo.php';

class Estacionamiento
{
    private $nombre;
    private $listaAutos;

//#region Constructores
    function __construct($nom)
    {
        $this->nombre = $nom;
        $this->listaAutos = array();
    }

//#endregion


//#region Archivos json

    /**
    *
    *
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
    *
    *
    *
    */
    public static function agregarVehiculosEstacionamientoJson($lista)
    {
        $listadoVehiculos = $lista;
        echo "agregarVehiculosEstacionamiento";
        $archivo = fopen("estacionamiento.json", "w");

        var_dump($listadoVehiculos);

        foreach ($listadoVehiculos as $key )
        {
          if(! ($key->getPatente()=='' || $key->getPatente()=='\n'))
          {
              $array = array('patente' => $key->getPatente(), 'fecha' => date("d/m/y"),'precio' =>0);
              fputs($archivo,  json_encode($array, JSON_PRETTY_PRINT).',');
          }

        }

        fclose($archivo);
        return $listadoVehiculos;
    }

    //#endregion


//#region Archivos csv txt
    public static function Leer($formato)
    {
    $listadoVehiculos = array();

    switch ($formato) {
        case "csv":
        $archivo = fopen("estacionamiento.csv", "r");
            break;
        case "txt":
        $archivo = fopen("estacionamiento.txt", "r");
            break;
     }

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

    public static function agregarVehiculosEstacionamiento($lista, $vehiculoAgregar,$formato)
    {
        $listadoVehiculos = $lista;
            
    switch ($formato) {
        case "csv":
        $archivo = fopen("estacionamiento.csv", "a+");
            break;
        case "txt":
        $archivo = fopen("estacionamiento.txt", "a+");
            break;
     }
    
        echo "<h1>agregarVehiculosEstacionamiento<br> </h1>";
        

        $aux = implode(',', $vehiculoAgregar->toArray());

        fputs($archivo,  $aux."\n");

        fclose($archivo);
        return $listadoVehiculos;
    }

//#endregion


//#region Funciones

    public static function vehiculoEstacionado($patent)
    {
       $listadoVehiculo= Estacionamiento::Leer("csv");        
      // $listadoVehiculo= Estacionamiento::Leer("txt");        

        $auto = Estacionamiento::estaEstacionado($patent, $listadoVehiculo);

        if ($auto==null)
        {
            $autoNuevo = new Vehiculo($patent, date("d/m/y"), 0);
            array_push($listadoVehiculo, $autoNuevo);
            Estacionamiento::agregarVehiculosEstacionamiento($listadoVehiculo, $autoNuevo, "txt");
            Estacionamiento::agregarVehiculosEstacionamiento($listadoVehiculo, $autoNuevo, "csv");
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

//#endregion
}
