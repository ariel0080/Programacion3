
<?php

include_once 'producto.php';

class contenedor
{

    public $id;
    public $capacidad;
    public $tam;
    public $listadoProductos;

    public function __construct($tamanio)
    {

        $this->id        = '0';
        $this->tam       = $tamanio;
        $this->capacidad = '0';
        // $this->definirCapacidad($tamanio);
        $this->listadoProductos = array();

    }

    public function mostrar()
    {
        echo "<br>Id " . $this->id . "<br>" . "Capacidad " . $this->capacidad . "<br> Tamaño " . $this->tam;
        foreach ($listadoProductos as $value) {

            $value->mostrar();
        }

    }

    public function agregarProducto($productoAgregar)
    {
        $bandera = false;

        if (($this->acumuladaCapacidad() + $productoAgregar->kilos) <= $this->maximaCapacidad) {
            foreach ($this->listadoProductos as $value) {
                if ($value->id == $productoAgregar->id) {
                    $this->capacidad += $productoAgregar->kilos;
                    $bandera = true;
                    break;
                }

            }

            if ($bandera != true) {
                array_push($this->listadoProductos, $productoAgregar);
            }
        } else {
            echo " NO HAY LUGAR";

        }

        // si existe y hay kg libres los sumo a los kg
        //si no existe y hay kg libre lo agrego // funcion que diga disponibilidad de kg
        // si no hay kg libre

    }

    public function maximaCapacidad($tamaño)
    {
        $aux;

        switch ($tamaño) {
            case 'grande':
                $aux = $this->capacidad = "9000";
                break;
            case 'mediano':
                $aux = $this->capacidad = "2500";
                break;
            case 'chico':
                $aux = $this->capacidad = "1000";
                break;
        }

        return $aux;
    }

    public function acumuladaCapacidad($tamaño)
    {
        $aux;

        foreach ($listadoProductos as $value) {
            $aux += $value->kilos;

        }

        return $aux;
    }

}

?>