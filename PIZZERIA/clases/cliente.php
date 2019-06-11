<?php

class Cliente
{
    private $nombre;
    private $producto;
    private $precio;
    private $cantidad;

    //#region Constructores
    function __construct($eproducto , $enombre , $eprecio, $ecantidad)
    {
        $this->producto = $eproducto;
        $this->nombre = $enombre;
        $this->precio = $eprecio;
        $this->cantidad = $ecantidad;
    }
    //#endregion

    //#region GETTER SETTERS
    public function getProducto()
    {
        return $this->producto;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getPrecio()
    {
        return $this->precio;
    }
    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function setproducto($var)
    {
        $this->producto = $var;
    }
    public function setNombre($var)
    {
        $this->nombre = $var;
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

    public function MostrarCliente()
    {
        echo "nombre: $this->nombre || producto: $this->producto || precio: $this->precio || cantidad: $this->cantidad";
    }

    public  function toArray()
    {
        $arrayAux = array();
        array_push($arrayAux, $this->nombre);
        array_push($arrayAux, $this->producto);
        array_push($arrayAux, $this->precio);
        array_push($arrayAux, $this->cantidad);
        array_push($arrayAux, "\n");

        return $arrayAux;
    }


//#endregion

}