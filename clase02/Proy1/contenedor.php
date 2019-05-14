
<?php

include_once './producto.php';

class contenedor
{

    public $id;
    public $capacidad;
    public $tam;
    public $listadoProductos;

    public function __construct($tamanio)
    {

        $this->id = '0';
        $this->tam = $tamanio;
        $this->capacidad = '0';
        // $this->definirCapacidad($tamanio);
        $this->listadoProductos = array();

    }

    public function mostrar()
    {
        echo "<br>Id " . $this->id . "<br>" . "Capacidad Maxima: " . $this->maximaCapacidad() . "<br>" . "Capacidad Ocupada: " . $this->acumuladaCapacidad() . "<br> Tamaño " . $this->tam;
        echo "<br><br> <font size='5' color='red'  face='verdana'> Lista de Productos </font>";
        foreach ($this->listadoProductos as $value) {

            $value->mostrar();
        }

    }

    public function agregarProducto($productoAgregar)
    {
        $bandera = false;

        if (($this->acumuladaCapacidad() + $productoAgregar->kilos) <= $this->maximaCapacidad()) {
            foreach ($this->listadoProductos as $value) {

                if ($value->id == $productoAgregar->id) {
                    // echo "KILOS". $value->$kilos."--".$productoAgregar->$kilos;
                    $value->kilos += $productoAgregar->kilos;
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

    public function maximaCapacidad()
    {
        $aux;

        switch ($this->tam) {
            case 'grande':
                $aux = "9000";
                break;
            case 'mediano':
                $aux = "2500";
                break;
            case 'chico':
                $aux = "1000";
                break;
        }

        return $aux;
    }

    public function acumuladaCapacidad()
    {
        $aux = '0';

        foreach ($this->listadoProductos as $value) {
            $aux += $value->kilos;
        }

        return $aux;
    }

}

?>