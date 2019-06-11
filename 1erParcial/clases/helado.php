<?php

class Helado
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

    public function MostrarHelado()
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

    
    public function crearTabla()
    {
        $strHtml = "";
        $strHtml .= "<tr>";
        $strHtml .= "<td>" . $this->getSabor() . "</td>";
        $strHtml .= "<td>" . $this->getTipo() . "</td>";
        $strHtml .= "<td>" . $this->getPrecio() . "</td>";
        $strHtml .= "<td>" . $this->getCantidad() . "</td>";

        $var = "./fotosHelados/" . $this->getSabor() .$this->getTipo() . ".png";

        if (file_exists($var)) {
            $strHtml .= "<td><img src=" . $var . " alt=" . " border=3 height=120px width=160px></img></td>";
        } else { // Buscar imagen que diga No Disponible
            $strHtml .= "<td>" . "Imagen NO Disponible" . "</td>";
        }
        return $strHtml;
    }


    public static function crearTablaHeader()
    {
        $strHtml = "<table border='1'>";
        $strHtml .= "<th>SABOR</th>";
        $strHtml .= "<th>TIPO</th>";
        $strHtml .= "<th>PRECIO</th>";
        $strHtml .= "<th>CANTIDAD</th>";
        $strHtml .= "<th>FOTO</th>";
        $strHtml .= "<tbody>";

        return $strHtml;
    }
}


    //#endregion


