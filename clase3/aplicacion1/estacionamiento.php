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
    public static function LeerJSON($nombreArchivo)
    {
        $listadoVehiculos = array();
        $archivo = file_get_contents($nombreArchivo . '.json');

        $json_data = json_decode($archivo, true);

        foreach ($json_data as $key => $value) {
            $auto = new Vehiculo($json_data[$key]["patente"], $json_data[$key]["fecha"], $json_data[$key]["precio"]);
            array_push($listadoVehiculos, $auto);
        }

        return $listadoVehiculos;
    }

    /**
     *
     *
     * 
     *
     */
    public static function guardarVehiculosEstacionamientoJson($lista, $nombreArchivo)
    {
        $listadoVehiculos = $lista;
        echo "agregarVehiculosEstacionamiento";
        $archivo = fopen($nombreArchivo . '.json', "w");

        var_dump($listadoVehiculos);

        foreach ($listadoVehiculos as $key) {
            if (!($key->getPatente() == '' || $key->getPatente() == '\n')) {
                $array = array('patente' => $key->getPatente(), 'fecha' => date("h:m"), 'precio' => 0);
                fputs($archivo,  json_encode($array, JSON_PRETTY_PRINT) . ',');
            }
        }

        fclose($archivo);
        return $listadoVehiculos;
    }

    //#endregion


    //#region Archivos csv txt
    public static function Leer($formato, $nombreArchivo)
    {
        $listadoVehiculos = array();

        switch ($formato) {
            case "csv":
                $archivo = fopen($nombreArchivo . '.csv', "r");
                break;
            case "txt":
                $archivo = fopen($nombreArchivo . '.txt', "r");
                break;
        }

        while (!feof($archivo)) {
            $renglon = fgets($archivo);

            $arrayDeDatos = explode(",", $renglon);

            $auto = new Vehiculo($arrayDeDatos[0], $arrayDeDatos[1], $arrayDeDatos[2]);

            array_push($listadoVehiculos, $auto);
        }

        fclose($archivo);
        return $listadoVehiculos;
    }

    public static function agregarVehiculosEstacionamiento($lista, $vehiculoAgregar, $formato, $nombreArchivo)
    {
        $listadoVehiculos = $lista;

        switch ($formato) {
            case "csv":
                $archivo = fopen($nombreArchivo . ".csv", "a+");
                break;
            case "txt":
                $archivo = fopen($nombreArchivo . ".txt", "a+");
                break;
        }

        echo "<h1>agregarVehiculosEstacionamiento<br> </h1>";

        $aux = implode(',', $vehiculoAgregar->toArray());

        fputs($archivo,  $aux . "\n");

        fclose($archivo);
        return $listadoVehiculos;
    }

    public static function guardarVehiculosEstacionamiento($lista, $formato, $nombreArchivo)
    {
        $listadoVehiculos = $lista;

        switch ($formato) {
            case "csv":
                $archivo = fopen($nombreArchivo . ".csv", "w");
                break;
            case "txt":
                $archivo = fopen($nombreArchivo . ".txt", "w");
                break;
        }

        echo "<h1>guardado de lista entera<br> </h1>";

        foreach ($lista as $vehiculoAgregar) {

            if (!($vehiculoAgregar->getPatente() == '' || $vehiculoAgregar->getPatente() == '\n' || $vehiculoAgregar->getPatente() == ',')) {
                $aux = implode(',', $vehiculoAgregar->toArray());
                fputs($archivo,  $aux);
            }
        }
        fclose($archivo);
        return $listadoVehiculos;
    }

    //#endregion


    //#region Funciones

    public static function vehiculoEstacionado($patent)
    {
        $listadoVehiculo = Estacionamiento::Leer("csv", "estacionamiento");
        //   $listadoVehiculo = Estacionamiento::Leer("txt");

        $auto = Estacionamiento::estaEstacionado($patent, $listadoVehiculo);

        if ($auto == null) {
            $autoNuevo = new Vehiculo($patent, date("h:m"), 0);
            array_push($listadoVehiculo, $autoNuevo);
            //AGREGAR
            //  Estacionamiento::agregarVehiculosEstacionamiento($listadoVehiculo, $autoNuevo, "txt", "estacionamiento");
            //  Estacionamiento::agregarVehiculosEstacionamiento($listadoVehiculo, $autoNuevo, "csv", "estacionamiento");

            //GUARDAR TODO
            Estacionamiento::guardarVehiculosEstacionamiento($listadoVehiculo, "txt", "estacionamiento");
            Estacionamiento::guardarVehiculosEstacionamiento($listadoVehiculo, "csv", "estacionamiento");
            Estacionamiento::guardarVehiculosEstacionamientoJson($listadoVehiculo, "estacionamiento");
           
        }
    }

    public static function removervehiculoEstacionado($patent)
    {
        $listadoVehiculo = Estacionamiento::Leer("csv", "estacionamiento");

        $auto = Estacionamiento::estaEstacionado($patent, $listadoVehiculo);

        $auto->MostrarAuto();

        if ($auto != null) {
            unset($listadoVehiculo, $auto);
            Estacionamiento::guardarVehiculosEstacionamiento($listadoVehiculo, "csv", "estacionamiento");
            Estacionamiento::guardarVehiculosEstacionamiento($listadoVehiculo, "txt", "estacionamiento");
            Estacionamiento::agregarVehiculosEstacionamientoJson($listadoVehiculo, "estacionamiento");
            echo "deberia haber borrado el auto";

            $auto->setImporte();
            Estacionamiento::agregarVehiculosEstacionamiento($listadoVehiculo, $auto, "csv", "facturado");
        }
    }

    public static function estaEstacionado($patent, $listadoVehiculo)
    {
        foreach ($listadoVehiculo as $auto) {
            if ($auto->getPatente() == $patent) {
                echo "Esta en el estacionamiento";
                return $auto;
                break;
            }
        }
        return null;
    }

    //#endregion
}
