
<?php

class Auto
{
    private $marca;
    private $color;
    private $fecha;
    private $precio;

    public function __construct($nuevoColor, $nuevoPrecio, $nuevoMarca, $nuevoFecha)
    {
        $this->color = $nuevoColor;
        $this->precio = $nuevoPrecio;
        $this->marca = $nuevoMarca;
        $this->fecha = $nuevoFecha;

    }


    function static AgregarImpuestos ($sumarAlPrecio)
    {
        $this->precio += $sumarAlPrecio;
    }
    function  MostrarAuto()
    {
        echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold'>
        Auto </font>  Marca: ".$this->marca."<br> Color: ".$this->color.
        "<br> Precio: ".$this->precio."<br> Fecha: ".$this->fecha;
    }
}

?>
