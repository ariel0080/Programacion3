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

     */
    public static function guardarVehiculosEstacionamientoJson($lista, $nombreArchivo)
    {
        $listadoVehiculos = $lista;
        echo "agregarVehiculosEstacionamiento";
        $archivo = fopen($nombreArchivo . '.json', "w");

        echo '<pre>', var_dump($listadoVehiculos), '</pre>';

        foreach ($listadoVehiculos as $key) {
            if (!($key->getPatente() == '' || $key->getPatente() == '\n')) {
                $array = array('patente' => $key->getPatente(), 'fecha' => date("h:m"), 'precio' => 0);
                fputs($archivo,  json_encode($array, JSON_PRETTY_PRINT) . ',');
            }
        }

        fclose($archivo);
        return $listadoVehiculos;
    }

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

            $arrayDeDatos = explode(',', $renglon);

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

        echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold' <br>Agregar elemento en csv o txt <br> </font>";

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

        echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold' <br>Lista Guardada COMPLETA en csv o txt <br> </font>";

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
      public static function vehiculoEstacionado($foto, $patent)
    {
        $listadoVehiculo = Estacionamiento::Leer("csv", "estacionamiento");
        $auto = Estacionamiento::estaEstacionado($patent, $listadoVehiculo);

        if ($auto == null) {

            $autoNuevo = new Vehiculo($patent, date("h:m"), 0);
            echo "cargar imagen";
            Upload::cargarImagenPorNombre($foto , $patent);
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


    public static function MostrarEstacionas()
    {
        $listadoVehiculo = Estacionamiento::Leer("csv", "estacionamiento");

        foreach ($listadoVehiculo as $key => $auto) {
            if ($auto->getPatente() != '') {
                $auto->MostrarAuto();
                echo "<br>";
            }
        }
    }
    public static function MostrarFacturado()
    {
        $listadoVehiculo = Estacionamiento::Leer("csv", "facturado");
        $acumulador = 0;

        foreach ($listadoVehiculo as $key => $auto) {
            if ($auto->getPatente() != '') {
                $auto->MostrarAuto();
                $acumulador += $auto->getImporte();
                echo "<br>";
            }
        }

        echo " el total facturado fue $acumulador";
    }

    public static function removervehiculoEstacionado($foto)
    {
        $listadoVehiculo = Estacionamiento::Leer("csv", "estacionamiento");
        $auto = Estacionamiento::estaEstacionadoKey($foto, $listadoVehiculo);
        echo ' <br><br><br> el auto esta en: ' . $auto;
        //  $listadoVehiculo[$auto]->MostrarAuto();
        if ($auto != null) {
            echo " <br> el auto se encuntra en el estacionamiento <br> ";
            $listadoFacturado = Estacionamiento::Leer("csv", "facturado");
            $listadoVehiculo[$auto]->setImporte();
            array_push($listadoFacturado, $listadoVehiculo[$auto]);
            echo '<pre>', var_dump($listadoFacturado), '</pre>';
            Estacionamiento::guardarVehiculosEstacionamiento($listadoFacturado, "csv", "facturado");


            unset($listadoVehiculo[$auto]);

            Estacionamiento::guardarVehiculosEstacionamiento($listadoVehiculo, "csv", "estacionamiento");
            Estacionamiento::guardarVehiculosEstacionamiento($listadoVehiculo, "txt", "estacionamiento");
            Estacionamiento::guardarVehiculosEstacionamientoJson($listadoVehiculo, "estacionamiento");
            echo "deberia haber guardado sin el auto borrado";
        }
    }

    public static function estaEstacionado($foto, $listadoVehiculo)
    {
        foreach ($listadoVehiculo as $auto) {
            if ($auto->getPatente() == $foto) {
                echo "Esta en el estacionamiento";
                return $auto;
                break;
            }
        }
        return null;
    }
    public static function estaEstacionadoKey($foto, $listadoVehiculo)
    {
        foreach ($listadoVehiculo as $key => $auto) {
            if ($auto->getPatente() == $foto) {
                echo "Esta en el estacionamiento";
                return $key;
                break;
            }
        }
        return null;
    }

    //#endregion
}
