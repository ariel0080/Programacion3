
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

    public function MostrarAuto()
    {
        echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold'>
        Auto <br> </font>  Marca: " . $this->marca . "<br> Color: " . $this->color .
        "<br> Precio: " . $this->precio . "<br> Fecha: " . $this->fecha;
    }

    public static function Equals($auto1, $auto2)
    {
        if ($auto1->marca == $auto2->marca) {
            return true;
        }
    }

    public static function Add($auto1, $autoAgregar)
    {
        if ($auto1->marca == $autoAgregar->marca && $auto1->color == $autoAgregar->color) {
            return $auto1->precio + $autoAgregar->precio;
        } else {
            echo "<br>LOS AUTOS NO SON IGUALES";
            return 0;
        }
    }

     public function AgregarImpuestos($sumarAlPrecio)
     {
     $this->precio = $this->precio + $sumarAlPrecio;

   }





}

?>
