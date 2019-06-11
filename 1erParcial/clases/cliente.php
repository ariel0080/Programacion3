<?php

class Cliente
{
    private $nombre;
    private $helado;
    private $precio;
    private $cantidadKg;

    //#region Constructores
    function __construct($ehelado, $enombre, $eprecio, $ecantidadKg)
    {
        $this->helado = $ehelado;
        $this->nombre = $enombre;
        $this->precio = $eprecio;
        $this->cantidadKg = $ecantidadKg;
    }
    //#endregion

    //#region GETTER SETTERS
    public function gethelado()
    {
        return $this->helado;
    }
    public function getnombre()
    {
        return $this->nombre;
    }
    public function getPrecio()
    {
        return $this->precio;
    }
    public function getcantidadKg()
    {
        return $this->cantidadKg;
    }

    public function sethelado($var)
    {
        $this->helado = $var;
    }
    public function setnombre($var)
    {
        $this->nombre = $var;
    }
    public function setPrecio($var)
    {
        $this->precio = $var;
    }
    public function setcantidadKg($var)
    {
        $this->cantidadKg = $var;
    }
    //#endregion


    //#region GETTER SETTERS

    public function MostrarCliente()
    {
        echo "nombre: $this->nombre || helado: $this->helado || precio: $this->precio || cantidadKg: $this->cantidadKg";
    }

    public  function toArray()
    {
        $arrayAux = array();
        array_push($arrayAux, $this->nombre);
        array_push($arrayAux, $this->helado);
        array_push($arrayAux, $this->precio);
        array_push($arrayAux, $this->cantidadKg);
        array_push($arrayAux, "\n");

        return $arrayAux;
    }


    //#endregion




    public function crearTabla()
    {
        $strHtml = "";
        $strHtml .= "<tr>";
        $strHtml .= "<td>" . $this->gethelado() . "</td>";
        $strHtml .= "<td>" . $this->getnombre() . "</td>";
        $strHtml .= "<td>" . $this->getPrecio() . "</td>";
        $strHtml .= "<td>" . $this->getcantidadKg() . "</td>";

        $nombreFile = "venta".$this->getnombre() . $this->gethelado();

        $var = "./fotosVentas/" . $nombreFile . ".png";

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
        $strHtml .= "<th>HELADO</th>";
        $strHtml .= "<th>CLIENTE</th>";
        $strHtml .= "<th>PRECIO</th>";
        $strHtml .= "<th>CANTIDAD</th>";
        $strHtml .= "<th>FOTO</th>";
        $strHtml .= "<tbody>";

        return $strHtml;
    }
}
