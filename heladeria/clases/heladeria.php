<?php
require_once 'cliente.php';
require_once 'helado.php';


class Heladeria
{
    private $nombre;
    private $listaHelados;
    private $listaVentas;


    //#region Constructores
    function __construct($nom)
    {
        $this->nombre = $nom;
        $this->listaHelados = array();
        $this->listaVentas = array();
    }

    //#endregion


    //#region Archivos

    public static function Leer($formato, $nombreArchivo, $tipo)
    {
        $listado = array();

        switch ($formato) {
            case "csv":
                $archivo = fopen($nombreArchivo, "r");
                break;
            case "txt":
                $archivo = fopen($nombreArchivo, "r");
                break;
        }
        while (!feof($archivo)) {
            $renglon = fgets($archivo);

            $arrayDeDatos = explode(',', $renglon);

            if (isset($arrayDeDatos)) {

                switch ($tipo) {
                    case 'helado':
                        $helado = new Helado($arrayDeDatos[0], $arrayDeDatos[1], $arrayDeDatos[2], $arrayDeDatos[3]);
                        array_push($listado, $helado);
                    case 'venta':
                        $cliente = new Cliente($arrayDeDatos[0], $arrayDeDatos[1], $arrayDeDatos[2], $arrayDeDatos[3]);
                        array_push($listado, $cliente);
                }
            }
        }
        fclose($archivo);
        return $listado;
    }


    public static function LeerJSON($nombreArchivo, $tipo)
    {

        $ruta = $nombreArchivo;

        if (file_exists($ruta)) {

            $archivo = fopen($ruta, "r");
            $listado = array();
            while (!feof($archivo)) {
                $renglon = fgets($archivo);
                if ($renglon != "") {
                    $objeto = json_decode($renglon);
                    switch ($tipo) {
                        case 'helado':
                            if (isset($objeto)) {
                                $helado = new Helado($objeto->sabor, $objeto->tipo,  $objeto->cantidad, $objeto->precio);
                                array_push($listado, $helado);
                            }
                            break;

                        case 'venta':
                            $cliente = new Cliente($objeto->nombre, $objeto->helado, $objeto->precio, $objeto->cantidadKg);
                            array_push($listado, $cliente);
                            break;
                    }
                }
            }
            fclose($archivo);
            if (count($listado) > 0) {

                return $listado;
            }
        }
        return null;
    }



    /**

     */
    public static function guardarJsonHeladeria($lista, $nombreArchivo, $tipo) //SEGUIR ACA
    {
        $listado = $lista;
        echo "agregarVehiculosHeladeria";
        $archivo = fopen($nombreArchivo, "w");

        echo '<pre>', var_dump($listado), '</pre>';

        foreach ($listado as $key) {
            switch ($tipo) {
                case 'helado':
                    if (!($key->getSabor() == '' || $key->getSabor() == '\n')) {
                        $array = array('sabor' => $key->getSabor(), 'tipo' => $key->getTipo(), 'precio' => $key->getPrecio(), 'cantidad' => $key->getCantidad());
                        array_push($listado, $array);
                        fputs($archivo,  json_encode($array) . PHP_EOL);
                    }
                    break;
                case 'venta':
                    if (!($key->getnombre() == '' || $key->getnombre() == '\n')) {
                        $array = array('nombre' => $key->getnombre(), 'helado' => $key->gethelado(), 'precio' => $key->getPrecio(), 'cantidadKg' => $key->getcantidadKg());
                        array_push($listado, $array);
                        fputs($archivo,  json_encode($array) . PHP_EOL);
                    }
                    break;
            }
        }

        fclose($archivo);
        return $listado;
    }



    public static function guardarEnHeladeria($lista, $nombreArchivo, $tipo)
    {
        $archivo = fopen($nombreArchivo, "w");

        echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold' <br>Lista Guardada COMPLETA en csv o txt <br> </font>";

        foreach ($lista as $objeto) {

            switch ($tipo) {
                case 'helado':
                    if (!($objeto->getSabor() == '' || $objeto->getSabor() == '\n' || $objeto->getSabor() == ',')) {
                        $aux = implode(',', $objeto->toArray());
                        fputs($archivo,  $aux);
                    }
                    break;
                case 'venta':
                    if (!($objeto->getnombre() == '' || $objeto->getnombre() == '\n' || $objeto->getnombre() == ',')) {
                        $aux = implode(',', $objeto->toArray());
                        fputs($archivo,  $aux);
                    }
                    break;
            }
        }
        fclose($archivo);
        return $$lista;
    }

    //#endRegion

    public static function ListarTodo($tipo)
    {
        echo $tipo;

        switch ($tipo) {
            case 'helado':
                $lista = self::LeerJSON("./archivos/helados.txt", "helado");
                foreach ($lista as $objeto) {
                    $objeto->MostrarHelado();
                }
                break;

            case 'venta':
                $lista = self::LeerJSON("./archivos/ventas.txt", "venta");
                foreach ($lista as $objeto) {
                    $objeto->MostrarCliente();
                }
                break;
        }
    }



  /*   public static function agregarHelado($sabor, $tipo, $cantidad, $precio)
    {
        $lista = self::LeerJSON("./archivos/helados.txt", "helado");
        $helado = self::existeHelado($lista, $sabor, $tipo);

        if ($helado == null) {

            $nuevoHelado = new Helado($sabor, $tipo, $cantidad, $precio);
            array_push($lista, $nuevoHelado);

            self::guardarJsonHeladeria($lista, "./archivos/helados.txt", "helado");
        }
    } */


    public static function agregarHeladoConFoto($sabor, $tipo, $cantidad, $precio, $fotoHelado)
    {
        $lista = self::LeerJSON("./archivos/helados.txt", "helado");
        $helado = self::existeHelado($lista, $sabor, $tipo);

        if ($helado == null) {

            $nuevoHelado = new Helado($sabor, $tipo, $cantidad, $precio);

            echo "nombre archivo ($sabor.$tipo)";
            var_dump($fotoHelado);
            Upload::cargarImagenPorNombre($fotoHelado, ($sabor . $tipo));
            array_push($lista, $nuevoHelado);

            self::guardarJsonHeladeria($lista, "./archivos/helados.txt", "helado");
        }
    }


    public static function existeHelado($lista, $sabor, $tipo)
    {
        foreach ($lista as $helado) {
            if ($helado->getSabor() == $sabor && $helado->getTipo() == $tipo) {
                echo "<font size='3' color='red'  face='verdana' style='font-weight:bold' <br>Este helado ya se Encuentra en el Heladeria <br> </font>";
                return $helado;
                break;
            }
        }
        return null;
    }

    public static function hayKilosHelado($lista, $sabor, $tipo, $cantidad)
    {
        foreach ($lista as $helado) {
            if ($helado->getSabor() == $sabor && $helado->getTipo() == $tipo && $helado->getCantidad() >= $cantidad) {
                echo "<font size='3' color='red'  face='verdana' style='font-weight:bold' <br>Este helado ya se Encuentra en el Heladeria <br> </font>";
                return $helado;
                break;
            }
        }
        return null;
    }
}






























 /*    public static function guardarJsonEnHeladeria($lista, $nombreArchivo, $tipo)
    {
        $listado = $lista;
        $archivo = fopen($nombreArchivo, "w");


        foreach ($listado as $objeto) {

            switch ($tipo) {
                case 'helado':
                    if (!($objeto->getSabor() == '' || $objeto->getSabor() == '\n' || $objeto->getSabor() == ',')) {
                        $array = array('sabor' => $key->getSabor(), 'clave' => $key->getClave(), 'fecha' => $key->getFecha(), 'mail' => $key->getMail());
                    }
                case 'venta':
                    if (!($objeto->getnombre() == '' || $objeto->getnombre() == '\n' || $objeto->getnombre() == ',')) {
                        $aux = implode(',', $objeto->toArray());
                    }
            }

            fputs($archivo,  json_encode($array) . PHP_EOL);
        }

        fclose($archivo);
        return $listado;
    } */




    //#endregion
