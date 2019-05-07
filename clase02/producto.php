
<?php

class producto
{

    public $id;
    public $nombre;
    public $importador;
    public $pais;
    public $kilos;


function __construct()
{
    $this->nombre     = '0';
    $this->importador = '0';
    $this->id         = '0';
    $this->pais       = '0';
    $this->kilos      = '0';
}

function mostrar()
{
    echo "<br>Id: " . $this->id . "<br>" . "Importador: " . $this->importador . "<br> Nombre: " . $this->nombre;
    echo "<br>Pais: " . $this->pais . "<br>" . "Kilos: " . $this->kilos;
}


}



?>