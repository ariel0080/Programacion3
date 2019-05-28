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

          $listado = array();
          $archivo = file_get_contents($nombreArchivo . '.json');
  
          $json_data = json_decode($archivo, true);
  
          foreach ($json_data as $key => $value) {
            $usuario = new Vehiculo($json_data[$key]["alias"], $json_data[$key]["clave"], $json_data[$key]["fecha"],  $json_data[$key]["mail"]);
              array_push($listado, $usuario);
          }
  
          return $listado;
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
  
          foreach ($listado as $key)
          {
              if (!($key->getAlias() == '' || $key->getAlias() == '\n'))
              {
                  $array = array('alias' => $key->getAlias(), 'clave' => $key->getClave(),'fecha' => $key->getFecha(), 'mail' => $key->getMail() );
                  fputs($archivo,  json_encode($array, JSON_PRETTY_PRINT) . ',');
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
        $listado = Estacionamiento::Leer("csv", "estacionamiento");

        $usuario = Estacionamiento::estaEnArray($aliass, $listado);

        if ($usuario == null) {
            $usuarioNuevo = new Vehiculo($aliass, date("h:m"), 0);
            array_push($listado, $usuarioNuevo);
            //AGREGAR
            //  Estacionamiento::agregarVehiculosEstacionamiento($listado, $usuarioNuevo, "txt", "estacionamiento");
            //  Estacionamiento::agregarVehiculosEstacionamiento($listado, $usuarioNuevo, "csv", "estacionamiento");

            //GUARDAR TODO
            Estacionamiento::guardarVehiculosEstacionamiento($listado, "txt", "estacionamiento");
            Estacionamiento::guardarVehiculosEstacionamiento($listado, "csv", "estacionamiento");
            Estacionamiento::guardarVehiculosEstacionamientoJson($listado, "estacionamiento");
        }
    }
    public static function altaUsuario($alia, $pass, $email)
    {        
            $usuarioNuevo = new Usuario($alia, $pass, $email);
            array_push($listado, $usuarioNuevo);
    
    }

    public static function MostrarLogueados()
    {
        $listado = Estacionamiento::Leer("csv", "estacionamiento");

        foreach ($listado as $key => $usuario) {
            if ($usuario->getAlias() != '') {
                $usuario->MostrarUsuario();
                echo "<br>";
            }
        }
    }

    public static function MostrarTodos()
    {
        $listado = Estacionamiento::Leer("csv", "facturado");
        $acumulador = 0;

        foreach ($listado as $key => $usuario)
         {
            if ($usuario->getAlias() != '') {
                $usuario->MostrarUsuario();
                echo "<br>";
            }
        }

        echo " el total facturado fue $acumulador";
    }

    public static function removervehiculoEstacionado($aliass)
    {
        $listado = Estacionamiento::Leer("csv", "estacionamiento");
        $usuario = Estacionamiento::estaEnArrayKey($aliass, $listado);
        echo ' <br><br><br> el usuario esta en: ' . $usuario;
        //  $listado[$usuario]->MostrarUsuario();
        if ($usuario != null) {
            echo " <br> el auto se encuntra en el estacionamiento <br> ";
            $listadoFacturado = Estacionamiento::Leer("csv", "facturado");
            $listado[$usuario]->setImporte();
            array_push($listadoFacturado, $listado[$usuario]);
            echo '<pre>', var_dump($listadoFacturado), '</pre>';
            Estacionamiento::guardarVehiculosEstacionamiento($listadoFacturado, "csv", "facturado");


            unset($listado[$usuario]);

            Estacionamiento::guardarVehiculosEstacionamiento($listado, "csv", "estacionamiento");
            Estacionamiento::guardarVehiculosEstacionamiento($listado, "txt", "estacionamiento");
            Estacionamiento::guardarVehiculosEstacionamientoJson($listado, "estacionamiento");
            echo "deberia haber guardado sin el auto borrado";
        }
    }

    public static function estaEnArray($aliass, $listado)
    {
        foreach ($listado as $usuario) {
            if ($usuario->getAlias() == $aliass) {
                echo "Esta en el estacionamiento";
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
                echo "Esta en el estacionamiento";
                return $key;
                break;
            }
        }
        return null;
    }


}
