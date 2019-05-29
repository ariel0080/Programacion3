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

  /////////////////////////LEERS
  public static function leerJSON($nombreArchivo)
  {
    $ruta = $nombreArchivo . '.json';

    if (file_exists($ruta)) {

      $archivo = fopen($ruta, "r");
      $productos = array();
      while (!feof($archivo)) {
        $renglon = fgets($archivo);
        if ($renglon != "") {
          $objeto = json_decode($renglon);
          $producto = new Usuario($objeto->alias, $objeto->clave, $objeto->fecha, $objeto->mail);
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

      if (isset($arrayDeDatos[0]) && isset($arrayDeDatos[1]) && isset($arrayDeDatos[2]) && isset($arrayDeDatos[3])) {
        $auto = new Usuario($arrayDeDatos[0], $arrayDeDatos[1], $arrayDeDatos[2], $arrayDeDatos[3]);
        array_push($listadoVehiculos, $auto);
      }
    }

    fclose($archivo);
    return $listadoVehiculos;
  }

  /////////////////////////GUARDARS
  public static function guardarJsonListadoArchivo($lista, $nombreArchivo)
  {
    $listado = $lista;
    $archivo = fopen($nombreArchivo . '.json', "w");

    /*   echo '<pre>', var_dump($listado), '</pre>'; */

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

  //////////////////////////// ALTA Y METODOS CON ARCHIVOS

  public static function altaLog($aliass, $pass)
  {
    $listado = self::leerJSON("./archivos/usuarios");
    $usuario = LogIn::estaEnArray($aliass, $pass, $listado);

    if ($usuario != null) {
      $logs = LogIn::Leer("csv", "./archivos/log");
      array_push($logs, $usuario);
      //AGREGAR
      // LogIn::agregarVehiculosEstacionamiento($listado, $usuarioNuevo, "txt", "estacionamiento");
      //  LogIn::agregarVehiculosEstacionamiento($listado, $usuario, "csv", "./archivos/log");

      //GUARDAR TODO
      //LogIn::guardarVehiculosEstacionamiento($listado, "txt", "estacionamiento");
      LogIn::guardarListadoArchivo($listado, "csv", "./archivos/log");
      //  LogIn::guardarVehiculosEstacionamientoJson($listado, "estacionamiento"); 
    }
  }


  public static function altaUsuario($alia, $pass, $email)
  {
    $listado = self::leerJSON("./archivos/usuarios");
    $usuarioExiste = self::aliasExisteNombre($alia, $listado);

    if ($usuarioExiste == null) 
    {
      $usuarioNuevo = new Usuario($alia, $pass, date("Y-m-d h:m"), $email);
      array_push($listado, $usuarioNuevo);
      echo " todo el listado: ";
      var_dump($listado);
      LogIn::guardarJsonListadoArchivo($listado, "./archivos/usuarios");
    } else {
      echo " <br> El nombre de ususario ya existe <br>";
    }
  }



  ///////////////MOSTRARS

  public static function MostrarLogueados()
  {
    $listado = LogIn::Leer("csv", "./archivos/log");

    foreach ($listado as $usuario) {
      if ($usuario->getAlias() != '') {
        $usuario->MostrarUsuario();
        echo "<br>";
      }
    }
  }


  public static function MostrarTodos()
  {
    $listado = self::leerJSON("./archivos/usuarios");

    foreach ($listado as $key => $usuario) {
      if ($usuario->getAlias() != '') {
        $usuario->MostrarUsuario();
        echo "<br>";
      }
    }
  }




  public static function modificarUsuario($datoPut)
  {
    $listado = self::leerJSON("./archivos/usuarios");

    $arrayDeDatos =  $datoPut;
    echo "posicion alias" . $arrayDeDatos["alias"] . "<br>";

    if (isset($arrayDeDatos)) {
      foreach ($listado as $value) {

        if ($value->getAlias() == $arrayDeDatos["alias"]) {
          echo " entro al =";
          $value->setClave($arrayDeDatos["clave"]);
          LogIn::guardarJsonListadoArchivo($listado, "./archivos/usuarios");
          break;
        }
      }
    }
  }

  public static function removerUsuario($aliass)
  {
    $listado = self::leerJSON("./archivos/usuarios");
    $usuario = self::aliasExiste($aliass["alias"], $listado);

    if ($usuario >-1)     
    {
      echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold' <br><br><br><br> el usuario existe <br> </font>";
      unset($listado[$usuario]);
      LogIn::guardarJsonListadoArchivo($listado, "./archivos/usuarios");
    } else {
      echo "<font size='3' color='red'  face='verdana' style='font-weight:bold' <br><br><br><br>EL USUARIO NO EXISTE <br> </font>";
    }
  }




  ///////////BUSCARES
  public static function aliasExiste($aliass, $listado)
  {
    foreach ($listado as $key => $usuario) {
      if ($usuario->getAlias() == $aliass) {
        echo "<p>ALIAS existe</p>";
        return $key;
        break;
      }
    }
    return null;
  }

  public static function aliasExisteNombre($aliass, $listado)
  {
    foreach ($listado as  $usuario) {
      if ($usuario->getAlias() == $aliass) {
        echo "<p>ALIAS ya existe</p>";
        return $usuario;
        break;
      }
    }
    return null;
  }
  public static function estaEnArray($aliass, $pass, $listado)
  {
    foreach ($listado as $usuario) {
      if ($usuario->getAlias() == $aliass && $usuario->getClave() == $pass) {
        echo "<p>Esta en el LogIn</p>";
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
        echo "<p>Esta en el LogIn en key : $key</p>";
        return $key;
        break;
      }
    }
    return null;
  }
}
