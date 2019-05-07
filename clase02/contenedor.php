
<?php

require_once 'producto.php';

class contenedor
{

    public $id;
    public $capacidad;
    public $tam;
    public $listadoProductos;

    public function __construct()
    {

        $this->id               = '0';
        $this->capacidad        = '100';
        $this->tam              = 'grande';
        $this->listadoProductos = array();

    }

    public function mostrar()
    {
        echo "<br>Id " . $this->id . "<br>" . "Capacidad " . $this->capacidad . "<br> Tamaño " . $this->tam;
    }

    public function agregarProducto($productoAgregar)
    {

    	foreach ($this->listadoProductos => $value) 
    	{
    		if ($value == $productoAgregar)
    		{
    			$this->capacidad += $productoAgregar->kilos;
    		}




    	}

    	// si existe y hay kg libres los sumo a los kg
    	//si no existe y hay kg libre lo agrego // funcion que diga disponibilidad de kg
    	// si no hay kg libre 

    }

}

?>