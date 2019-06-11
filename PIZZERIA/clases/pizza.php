<?php

class Pizza
{
    private $sabor;
    private $tipo;
    private $precio;
    private $cantidad;

    //#region Constructores
    function __construct($esabor, $etipo, $ecantidad, $eprecio)
    {
        $this->tipo = $etipo;
        $this->sabor = $esabor;
        $this->precio = $eprecio;
        $this->cantidad = $ecantidad;
    }
    //#endregion

    //#region GETTER SETTERS
    public function getTipo()
    {
        return $this->tipo;
    }
    public function getSabor()
    {
        return $this->sabor;
    }
    public function getPrecio()
    {
        return $this->precio;
    }
    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function setTipo($var)
    {
        $this->tipo = $var;
    }
    public function setSabor($var)
    {
        $this->sabor = $var;
    }
    public function setPrecio($var)
    {
        $this->precio = $var;
    }
    public function setCantidad($var)
    {
        $this->cantidad = $var;
    }
    //#endregion


    //#region GETTER SETTERS

    public function MostrarPizza()
    {
        echo "sabor: $this->sabor || tipo: $this->tipo || precio: $this->precio || cantidad: $this->cantidad";
    }

    public  function toArray()
    {
        $arrayAux = array();
        array_push($arrayAux, $this->sabor);
        array_push($arrayAux, $this->tipo);
        array_push($arrayAux, $this->precio);
        array_push($arrayAux, $this->cantidad);
        array_push($arrayAux, "\n");

        return $arrayAux;
    }


    //#endregion

}
