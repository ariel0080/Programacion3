<?php

class Vehiculo
{
    private $patente;
    private $ingreso;
    private $importe;


    public function __construct($nuevoColor, $nuevoPrecio, $nuevoMarca)
    {
        $this->patente = $nuevoColor;
        $this->ingreso = $nuevoPrecio;
        $this->importe = $nuevoMarca;
    }

    public static function Leer()
    {
        $listadoVehiculos = array();
        $archivo = fopen("vehiculo.txt", "r");

        while (!feof($archivo)) {
            $renglon = fgets($archivo);

            $arrayDeDatos = explode(",", $renglon);

            $auto = new Vehiculo($arrayDeDatos[0], $arrayDeDatos[1], $arrayDeDatos[2]);

            array_push($listadoVehiculos, $auto);
        }

        fclose($archivo);
        return $listadoVehiculos;
    }

/*
public function getPrecio()
{
return $this->precio;
}
 */
    public function MostrarAuto()
    {
        echo "Patente: $this->patente || Ingreso: $this->ingreso || Importe: $this->importe";
    }

/*
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

}*/

}
