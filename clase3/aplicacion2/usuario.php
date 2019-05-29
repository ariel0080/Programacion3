<?php

class Usuario
{
    private $clave;
    private $alias;
    private $fecha;
    private $mail;

    //#region Constructores
    function __construct($alia, $pass, $date, $email)
    {
        $this->alias = $alia;
        $this->clave = $pass;
        $this->fecha = $date;
        $this->mail = $email;
    }
    //#endregion


    //#region GETTER SETTERS
    public function getAlias()
    {
        return $this->alias;
    }
    public function getClave()
    {
        return $this->clave;
    }
    public function getFecha()
    {
        return $this->fecha;
    }
    public function getMail()
    {
        return $this->mail;
    }

    public function setAlias($var)
    {
        $this->alias = $var;
    }
    public function setClave($var)
    {
        $this->clave = $var;
    }
    public function setFecha($var)
    {
        $this->fecha = $var;
    }
    public function setMail($var)
    {
        $this->mail = $var;
    }
    //#endregion



    //#region GETTER SETTERS

    public function MostrarUsuario()
    {
        echo "alias: $this->alias || clave: $this->clave || Importe: $this->fecha || Importe: $this->mail";
    }

    public  function toArray()
    {
        $arrayAux = array();
        array_push($arrayAux, $this->alias);
        array_push($arrayAux, $this->clave);
        array_push($arrayAux, $this->fecha);
        array_push($arrayAux, $this->mail);
        array_push($arrayAux, "\n");

        return $arrayAux;
    }


    //#endregion









}
