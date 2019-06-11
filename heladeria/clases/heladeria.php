<?php
require_once 'cliente.php';
require_once 'helado.php';
require_once "./recursos/upload.php";

define("ARCHIVOHELADO","./archivos/helados.txt",TRUE); 
define("ARCHIVOVENTA","./archivos/ventas.txt",TRUE); 


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
                            $cliente = new Cliente($objeto->helado, $objeto->nombre, $objeto->precio, $objeto->cantidadKg);
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
    public static function guardarJsonHeladeria($lista, $nombreArchivo, $tipo)
    {
        $listado = $lista;
        echo "<br>-- guardarJsonHeladeria $nombreArchivo --- <br>";
        $archivo = fopen($nombreArchivo, "w");


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
                $lista = self::LeerJSON( ARCHIVOHELADO , $tipo);
                foreach ($lista as $objeto) {
                    $objeto->MostrarHelado();
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
                $lista = self::LeerJSON(ARCHIVOHELADO, "helado");
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

    public static function consultarHelado($sabor, $tipo)
    {
        $auxsabor = false;
        $auxtipo = false;

        $lista = Heladeria::LeerJSON(ARCHIVOHELADO, "helado");
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

    public static function ListarVendidos($sabor, $tipo)
    {
        $lista=self::LeerJSON(ARCHIVOVENTA, "venta");
/*      echo "<br> lista ventas <br>";
        var_dump($lista); */
        $strHtml=self::crearTablaHeader($lista);
 
        foreach ($lista as $objeto) 
        {
            if (((strpos($objeto->gethelado(), $sabor) !== false)  || strpos($objeto->gethelado(), $tipo) !== false)) 
            {
                //mostrar venta...
                $strHtml.= "<tr>";
                $strHtml.= "<td>".$objeto->gethelado()."</td>";
                $strHtml.= "<td>".$objeto->getnombre()."</td>";
                $strHtml.= "<td>".$objeto->getPrecio()."</td>";
                $strHtml.= "<td>".$objeto->getcantidadKg()."</td>";

                $var = "./fotosHelados/" . $objeto->gethelado() . ".png";                
                
                if(file_exists($var))
                {                 
                    $strHtml.= "<td><img src=" . $var. " alt=" . "border=3 height=30% width=30%></img></td>";
                }
                else
                {// Buscar imagen que diga No Disponible
                    $strHtml.= "<td>"."Imagen NO Disponible"."</td>";
                }
            }
        } 
        $strHtml.="</tbody>";
        $strHtml.="</table>";
        echo $strHtml;
    }
    
    public static function crearTablaHeader($lista)
    {

        foreach($lista as $key => $objeto)
        {
            $strHtml="<table border='1'>";
            $strCabeceras = reset($lista);
            $strHtml.="<th>HELADO</th>";
            $strHtml.="<th>CLIENTE</th>";
            $strHtml.="<th>PRECIO</th>";
            $strHtml.="<th>CANTIDAD</th>";
            $strHtml.="<th>FOTO</th>";
            $strHtml.="<tbody>";
            
            return $strHtml;                    
        }


    }








    public static function crearTabla($helado)
    {

        $var = "./fotosHelados/" . $helado->getSabor() . $helado->getTipo() . ".png";
        echo "<tr>
                <table>
                <tr>
                <th><img src=" . $var . " alt=" . " border=3 height=30% width=30%></img></th>
                </tr>                
                <tr>
                <th>".$helado->getSabor()."</th>
                </tr>                
                <tr>
                <th>".$helado->getTipo()."</th>
                </tr>                
                <th>".$helado->getPrecio()."</th>
                </tr>                
                <tr>
                <th>".$helado->getCantidad()."</th>
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

            $listaHelados = Heladeria::LeerJSON(ARCHIVOHELADO, "helado");

            foreach ($listaHelados as $helado) {
                if ($helado->getSabor() == $sabor && $helado->getTipo() == $tipo) {

                    $helado->setCantidad($cantidad);

                    if ($precio != null) {
                        $helado->setPrecio($precio);
                    }
                    if ($helado->getCantidad() == 0) {
                        $key = (self::existeHeladoKey($listaHelados, $sabor, $tipo));
                        echo "<font size='3' color='red' face='verdana' style='font-weight:bold' <br>Archivo Eliminado <br> </font>";
                        unset($listaHelados[$key]);
                    }
                    break;
                }
            }
            self::guardarJsonHeladeria($listaHelados, ARCHIVOHELADO, "helado");
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
        $listaHelados = Heladeria::LeerJSON(ARCHIVOHELADO, "helado");

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
                $key = (self::existeHeladoKey($listaHelados, $sabor, $tipo));
                unset($listaHelados[$key]);
            }

            echo " <br> NUEVA Cantidad Disponible " . $helado->getCantidad() . " <br>";

            $cliente = new Cliente(($helado->getSabor() . $helado->getTipo()), $nombre, ($helado->getPrecio() * $cantidad), $cantidad);
            array_push($listaVentas, $cliente);

            if ($foto != null) {
                Upload::cargarImagenPorNombre($foto, ("venta$nombre" . date("d-m-y")), "./fotosVentas/");
            }

            self::guardarJsonHeladeria($listaVentas, ARCHIVOVENTA, "venta");
            self::guardarJsonHeladeria($listaHelados, ARCHIVOHELADO, "helado");
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
    public static function agregarHelado($sabor, $tipo, $cantidad, $precio)
    {
        $lista = self::LeerJSON(ARCHIVOHELADO, "helado");
        $helado = self::existeHelado($lista, $sabor, $tipo);

        if ($helado == null) {

            $nuevoHelado = new Helado($sabor, $tipo, $cantidad, $precio);
            array_push($lista, $nuevoHelado);
        } else {
            $helado->setCantidad($helado->getCantidad() + $cantidad);
            echo "la nueva cantidad de helado es " . $helado->getCantidad();
        }
        self::guardarJsonHeladeria($lista, ARCHIVOHELADO, "helado");
    }

    /**
     *
     */
    public static function agregarHeladoConFoto($sabor, $tipo, $cantidad, $precio, $fotoHelado)
    {
        $lista = self::LeerJSON(ARCHIVOHELADO, "helado");
        $helado = self::existeHelado($lista, $sabor, $tipo);

        if ($helado == null) {

            $nuevoHelado = new Helado($sabor, $tipo, $cantidad, $precio);

            echo "nombre archivo ($sabor.$tipo)";
            var_dump($fotoHelado);
            array_push($lista, $nuevoHelado);
        } else {
            $helado->setCantidad($helado->getCantidad() + $cantidad);
            echo "la nueva cantidad de helado es " . $helado->getCantidad();
        }
        Upload::cargarImagenPorNombre($fotoHelado, ($sabor . $tipo), "./fotosHelados/");
        self::guardarJsonHeladeria($lista, ARCHIVOHELADO, "helado");
    }

    /***
     *
     */
    public static function existeHelado($lista, $sabor, $tipo)
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

    public static function existeHeladoKey($lista, $sabor, $tipo)
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
