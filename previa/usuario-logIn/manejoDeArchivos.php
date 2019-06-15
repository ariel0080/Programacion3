<?php

class Archivos
{
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
    
            echo '<pre>', var_dump($listadoVehiculos), '</pre>';
    
            foreach ($listadoVehiculos as $key)
            {
                if (!($key->getPatente() == '' || $key->getPatente() == '\n'))
                {
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
}