<?php
require_once 'cliente.php';
require_once 'pizza.php';
require_once "./recursos/upload.php";

define("ARCHIVOPRODUCTO", "./archivos/pizza.txt");
define("ARCHIVO_FOTO_PRODUCTO", "./fotosPizzas/");
define("ARCHIVOVENTA","./archivos/ventas.txt",TRUE); 
define("PRODUCTO", "pizza");


class Pizzeria
{
    /*  private $nombre;
    private $listaHelados;
    private $listaVentas; */


    //#region Constructores
    /*     function __construct($nom)
    {
        $this->nombre = $nom;
        $this->listaHelados = array();
        $this->listaVentas = array();
    } */

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
                    case PRODUCTO:
                        $objeto = new Pizza($arrayDeDatos[0], $arrayDeDatos[1], $arrayDeDatos[2], $arrayDeDatos[3]);
                        array_push($listado, $objeto);
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
                        case PRODUCTO:
                            if (isset($objeto)) {
                                $objeto = new Pizza($objeto->sabor, $objeto->tipo,  $objeto->cantidad, $objeto->precio);
                                array_push($listado, $objeto);
                            }
                            break;

                        case 'venta':
                            $cliente = new Cliente($objeto->producto, $objeto->nombre, $objeto->precio, $objeto->cantidadKg);
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
    public static function guardarJson($lista, $nombreArchivo, $tipo)
    {
        $listado = $lista;
        echo "<br>-- guardarJson $nombreArchivo --- <br>";
        $archivo = fopen($nombreArchivo, "w");


        foreach ($listado as $key) {
            switch ($tipo) {
                case PRODUCTO:
                    if (!($key->getSabor() == '' || $key->getSabor() == '\n')) {
                        $array = array('sabor' => $key->getSabor(), 'tipo' => $key->getTipo(), 'precio' => $key->getPrecio(), 'cantidad' => $key->getCantidad());
                        array_push($listado, $array);
                        fputs($archivo,  json_encode($array) . PHP_EOL);
                    }
                    break;
                case 'venta':
                    if (!($key->getnombre() == '' || $key->getnombre() == '\n')) {

                        $array = array('nombre' => $key->getnombre(), 'producto' => $key->getpí(), 'precio' => $key->getPrecio(), 'cantidadKg' => $key->getcantidadKg());
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
                case PRODUCTO:
                    if (!($objeto->getSabor() == '' || $objeto->getSabor() == '\n' || $objeto->getSabor() == ',')) {
                        $aux = implode(',', $objeto->toArray());
                        fputs($archivo,  $aux);
                    }
                    break;
                case 'venta':
                    if (!($objeto->getNombre() == '' || $objeto->getNombre() == '\n' || $objeto->getnombre() == ',')) {
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
            case PRODUCTO:
                $lista = self::LeerJSON(ARCHIVOPRODUCTO, $tipo);
                foreach ($lista as $objeto) {
                    $objeto->MostrarPizza();
                }
                break;

            case 'venta':
                $lista = self::LeerJSON(ARCHIVOVENTA, $tipo);
                foreach ($lista as $objeto) {
                    $objeto->MostrarCliente();
                }
                break;
        }
    }


    /*     public static function ListarTodoFiltro($tipo)
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
                $lista = self::LeerJSON(ARCHIVOVENTA, "venta");
                foreach ($lista as $objeto) {
                    $objeto->MostrarCliente();
                }
                break;
        }
    }
 */
    /**
     * ITEM 3
     */

    public static function consultarProducto($sabor, $tipo)
    {
        $auxsabor = false;
        $auxtipo = false;

        $lista = Heladeria::LeerJSON(ARCHIVOPRODUCTO, PRODUCTO);
        foreach ($lista as $helado) {
            if ($helado->getSabor() == $sabor) {
                $auxsabor = true;

                if ($helado->getTipo() == $tipo) {
                    $auxtipo = true;
                }
            }
            self::crearTabla($helado);
        }
        if ($auxsabor && $auxtipo) {
            echo " <br> HAY HELADO DE SABOR Y TIPO<br> Cantidad Disponible " . $helado->getCantidad();
            self::crearTabla($helado);
        } else if ($auxsabor && !$auxtipo) {
            echo "<br> HAY HELADO DE SABOR pero NO TIPO <br> Tipo Disponible: " . $helado->getTipo() . "<br>Cantidad Disponible: " . $helado->getCantidad();
        } else {
            echo "No hay Helado";
        }
    }


    public static function crearTabla($helado)
    {

        $var = ARCHIVO_FOTO_PRODUCTO . $helado->getSabor() . $helado->getTipo() . ".png";
        echo "<tr>
                <table>
                <tr>
                <th><img src=" . $var . " alt=" . " border=3 height=30% width=30%></img></th>
                </tr>                
                <tr>
                <th>" . $helado->getSabor() . "</th>
                </tr>                
                <tr>
                <th>" . $helado->getTipo() . "</th>
                </tr>                
                <th>" . $helado->getPrecio() . "</th>
                </tr>                
                <tr>
                <th>" . $helado->getCantidad() . "</th>
                </tr>                
                </table> ";
    }






    /**
     * ITEM 4
     */

    public static function modificarHelado($_PUT)
    {

        if (isset($_PUT)) {
            $sabor  = $_PUT["sabor"];
            $tipo = $_PUT["tipo"];
            $cantidad = $_PUT["cantidad"];
            $precio = $_PUT["precio"];

            $listaHelados = self::LeerJSON(ARCHIVOPRODUCTO, PRODUCTO);

            foreach ($listaHelados as $helado) {
                if ($helado->getSabor() == $sabor && $helado->getTipo() == $tipo) {

                    $helado->setCantidad($cantidad);

                    if ($precio != null) {
                        $helado->setPrecio($precio);
                    }
                    if ($helado->getCantidad() == 0) {
                        $key = (self::existeProductoKey($listaHelados, $sabor, $tipo));
                        echo "<font size='3' color='red' face='verdana' style='font-weight:bold' <br>Archivo Eliminado <br> </font>";
                        unset($listaHelados[$key]);
                    }
                    break;
                }
            }
            self::guardarJson($listaHelados, ARCHIVOPRODUCTO, PRODUCTO);
        }
    }
    /**
     * ITEM 4
     */


    /**
     * ITEM 4
     */

    public static function nuevaVenta($sabor, $tipo, $cantidad, $nombre, $foto)
    {
        $listaHelados = self::LeerJSON(ARCHIVOPRODUCTO, PRODUCTO);

        foreach ($listaHelados as $helado) {
            if ($helado->getSabor() == $sabor) {
                $auxsabor = true;

                if ($helado->getTipo() == $tipo) {
                    $auxtipo = true;
                    break;
                }
            }
        }
        if ($auxsabor && $auxtipo && $helado->getCantidad() >= $cantidad) {
            $listaVentas = self::LeerJSON(ARCHIVOVENTA, "venta");
            if ($listaVentas == null) {
                $listaVentas = array();
            }
            echo " <br> HAY HELADO DE SABOR Y TIPO<br> Cantidad Disponible " . $helado->getCantidad();

            $helado->setCantidad($helado->getCantidad() - $cantidad);

            if ($helado->getCantidad() == 0) {
                $key = (self::existeProductoKey($listaHelados, $sabor, $tipo));
                unset($listaHelados[$key]);
            }

            echo " <br> NUEVA Cantidad Disponible " . $helado->getCantidad() . " <br>";

            $cliente = new Cliente(($helado->getSabor() . $helado->getTipo()), $nombre, ($helado->getPrecio() * $cantidad), $cantidad);
            array_push($listaVentas, $cliente);

            if ($foto != null) {
                Upload::cargarImagenPorNombre($foto, ("venta$nombre" . date("d-m-y")), "./fotosVentas/");
            }

            self::guardarJson($listaVentas, ARCHIVOVENTA, "venta");
            self::guardarJson($listaHelados, ARCHIVOPRODUCTO, "helado");
        } else if ($auxsabor && $auxtipo && $helado->getCantidad() < $cantidad) {
            echo " HAY PERO no alcanza";
        } else if ($auxsabor) {
            echo "<br>  HAY HELADO DE SABOR pero NO TIPO <br> Tipo Disponible: " . $helado->getTipo() . "<br>Cantidad Disponible: " . $helado->getCantidad();
        } else {
            echo "No hay Helado";
        }
    }

    /**
     *
     */
    public static function agregarProducto($sabor, $tipo, $cantidad, $precio, $fotoProducto)
    {
        $lista = self::LeerJSON(ARCHIVOPRODUCTO, PRODUCTO);

        echo "lista";
        var_dump($lista);


        $objeto = self::existeProducto($lista, $sabor, $tipo);

        if ($objeto == null) {

            $nuevoHelado = new Pizza($sabor, $tipo, $cantidad, $precio);

            echo "nombre archivo ($sabor.$tipo)";
            var_dump($fotoProducto);
            array_push($lista, $nuevoHelado);
        } else {
            $objeto->setCantidad($objeto->getCantidad() + $cantidad);
            echo "la nueva cantidad de helado es " . $objeto->getCantidad();
        }

        if ($fotoProducto != null) {
            
            Upload::cargarImagenPorNombre($fotoProducto, ($sabor . $tipo), ARCHIVO_FOTO_PRODUCTO);
        }
        self::guardarJson($lista, ARCHIVOPRODUCTO, PRODUCTO);
    }

    /***
     *
     */
    public static function existeProducto($lista, $sabor, $tipo)
    {
        $retorno = null;
        foreach ($lista as $helado) {
            if ($helado->getSabor() == $sabor && $helado->getTipo() == $tipo) {
                $retorno = $helado;
                break;
            }
        }
        return $retorno;
    }

    /**
     *
     */

    public static function existeProductoKey($lista, $sabor, $tipo)
    {
        $retorno = null;
        foreach ($lista as $key => $helado) {
            if ($helado->getSabor() == $sabor && $helado->getTipo() == $tipo) {
                $retorno = $key;
                break;
            }
        }
        return $retorno;
    }

    /**
     *
     */
    public static function hayKilosHelado($lista, $sabor, $tipo, $cantidad)
    {
        $retorno = null;
        foreach ($lista as $helado) {
            if ($helado->getSabor() == $sabor && $helado->getTipo() == $tipo && $helado->getCantidad() >= $cantidad) {
                echo "<font size='3' color='red' face='verdana' style='font-weight:bold' <br>Encontrado en Heladeria <br> </font>";
                $retorno = $helado;
                break;
            }
        }
        return $retorno;
    }
}
