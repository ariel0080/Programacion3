<?php

require_once 'usuario.php';

class LogIn
{
    private $nombre;
    private $listaUsuarios;

    //#region Constructores
    function __construct($nom)
    {
        $this->nombre = $nom;
        $this->listaUsuarios = array();
    }

    //#endregion

    //#region Archivos

    /**
     * lee por json
     */
    public static function leerJSON($nombreArchivo)
    {

        /*   $listado = array();
          $archivo = file_get_contents($nombreArchivo . '.json');
  
          $json_data = json_decode($archivo, true);
  
          foreach ($json_data as $key => $value) 
          {
            $usuario = new Usuario($json_data[$key]["alias"], $json_data[$key]["clave"], $json_data[$key]["fecha"],  $json_data[$key]["mail"]);
            array_push($listado, $usuario);
          }
  
          return $listado; */

        $ruta = $nombreArchivo . '.json';

        if (file_exists($ruta)) {

            $archivo = fopen($ruta, "r");
            $productos = array();
            while (!feof($archivo)) {

                $renglon = fgets($archivo);
                if ($renglon != "") {

                    $objeto = json_decode($renglon);
                     var_dump ( $objeto);

                    $producto = new Usuario($objeto->alias, $objeto->clave, $objeto->fecha, $objeto->mail);
/*                     
                    $producto = new Producto(, $objeto->bebida, $objeto->precio, $objeto->tipo, $objeto->cantidad); */
                    array_push($productos, $producto);
                }
            }
            fclose($archivo);
            if (count($productos) > 0) {

                return $productos;
            }
        }
        return null;
    }

    /**
     * guarda json
     */
    public static function guardarJsonListadoArchivo($lista, $nombreArchivo)
    {
        $listado = $lista;
        echo "agregar USUARIO log in json";
        $archivo = fopen($nombreArchivo . '.json', "w");

        echo '<pre>', var_dump($listado), '</pre>';

        foreach ($listado as $key) {
            if (!($key->getAlias() == '' || $key->getAlias() == '\n')) {
                $array = array('alias' => $key->getAlias(), 'clave' => $key->getClave(), 'fecha' => $key->getFecha(), 'mail' => $key->getMail());
                fputs($archivo,  json_encode($array) . PHP_EOL);
            }
        }

        fclose($archivo);
        return $listado;
    }

    public static function guardarListadoArchivo($lista, $formato, $nombreArchivo)
    {
        $listado = $lista;

        switch ($formato) {
            case "csv":
                $archivo = fopen($nombreArchivo . ".csv", "w");
                break;
            case "txt":
                $archivo = fopen($nombreArchivo . ".txt", "w");
                break;
        }

        echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold' <br>Lista Guardada COMPLETA en csv o txt <br> </font>";

        foreach ($lista as $key) {

            if (!($key->getAlias() == '' || $key->getAlias() == '\n' || $key->getAlias() == ',')) {
                $aux = implode(',', $key->toArray());
                fputs($archivo,  $aux);
            }
        }
        fclose($archivo);
        return $listado;
    }

    //#endregion

    //#region Funcion


    //#endregion

    public static function usuarioLogueado($aliass)
    {
        $listado = LogIn::Leer("csv", "estacionamiento");

        $usuario = LogIn::estaEnArray($aliass, $listado);

        if ($usuario == null) {
            $usuarioNuevo = new Vehiculo($aliass, date("h:m"), 0);
            array_push($listado, $usuarioNuevo);
            //AGREGAR
            // LogIn::agregarVehiculosEstacionamiento($listado, $usuarioNuevo, "txt", "estacionamiento");
            // LogIn::agregarVehiculosEstacionamiento($listado, $usuarioNuevo, "csv", "estacionamiento");

            //GUARDAR TODO
            /*      LogIn::guardarVehiculosEstacionamiento($listado, "txt", "estacionamiento");
           LogIn::guardarVehiculosEstacionamiento($listado, "csv", "estacionamiento");
           LogIn::guardarVehiculosEstacionamientoJson($listado, "estacionamiento"); */
        }
    }
    public static function altaUsuario($alia, $pass, $email)
    {
        $listado = self::leerJSON("./archivos/usuarios");
        if ($listado != null) {
            $usuarioNuevo = new Usuario($alia, $pass, $email);
            array_push($listado, $usuarioNuevo);
            var_dump($listado);
            LogIn::guardarJsonListadoArchivo($listado, "./archivos/usuarios");
        } else {
            echo " <br> no anda <br>";
        }
    }

    public static function MostrarLogueados()
    {
        $listado = LogIn::Leer("csv", "estacionamiento");

        foreach ($listado as $key => $usuario) {
            if ($usuario->getAlias() != '') {
                $usuario->MostrarUsuario();
                echo "<br>";
            }
        }
    }

    public static function MostrarTodos()
    {
        $listado = LogIn::Leer("csv", "facturado");
        $acumulador = 0;

        foreach ($listado as $key => $usuario) {
            if ($usuario->getAlias() != '') {
                $usuario->MostrarUsuario();
                echo "<br>";
            }
        }

        echo " el total facturado fue $acumulador";
    }

    public static function removervehiculoEstacionado($aliass)
    {
        $listado = LogIn::Leer("csv", "estacionamiento");
        $usuario = LogIn::estaEnArrayKey($aliass, $listado);
        echo ' <br><br><br> el usuario esta en: ' . $usuario;
        //  $listado[$usuario]->MostrarUsuario();
        if ($usuario != null) {
            echo " <br> el auto se encuntra en elLogIn <br> ";
            $listadoFacturado = LogIn::Leer("csv", "facturado");
            $listado[$usuario]->setImporte();
            array_push($listadoFacturado, $listado[$usuario]);
            echo '<pre>', var_dump($listadoFacturado), '</pre>';
            LogIn::guardarVehiculosEstacionamiento($listadoFacturado, "csv", "facturado");


            unset($listado[$usuario]);

            LogIn::guardarVehiculosEstacionamiento($listado, "csv", "estacionamiento");
            LogIn::guardarVehiculosEstacionamiento($listado, "txt", "estacionamiento");
            LogIn::guardarVehiculosEstacionamientoJson($listado, "estacionamiento");
            echo "deberia haber guardado sin el auto borrado";
        }
    }

    public static function estaEnArray($aliass, $listado)
    {
        foreach ($listado as $usuario) {
            if ($usuario->getAlias() == $aliass) {
                echo "Esta en elLogIn";
                return $usuario;
                break;
            }
        }
        return null;
    }
    public static function estaEnArrayKey($aliass, $listado)
    {
        foreach ($listado as $key => $usuario) {
            if ($usuario->getAlias() == $aliass) {
                echo "Esta en elLogIn";
                return $key;
                break;
            }
        }
        return null;
    }
}
