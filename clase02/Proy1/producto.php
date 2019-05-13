
<?php

class producto
{

    public $id;
    public $nombre;
    public $importador;
    public $pais;
    public $kilos;


function __construct($nom, $idd,$import, $pai, $kg )
{
    $this->nombre     = $nom;
    $this->importador = $import;  
    $this->id         = $idd;
    $this->pais       = $pai;
    $this->kilos      = $kg;
}

function mostrar()
{
    echo "<br><font size='2' color='blue'  face='verdana' style='font-weight:bold'>Id: " . $this->id ."<br> Nombre: " . $this->nombre. "</font><br>" . "Importador: " . $this->importador;
    echo "<br>Pais: " . $this->pais . "<br>" . "Kilos: " . $this->kilos;
}


}



?>