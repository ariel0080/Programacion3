<?php

require_once 'persona.php';

class Empleado extends Persona {

    private $estado;
    private $id;
    private $area;
    private $sueldo;
    private $antiguedad;

    //#region Constructores
    function __construct($enombre, $eapellido, $edni, $eedad, $eestado)
    {
        parent::__construct($enombre, $eapellido, $edni, $eedad);
        $this->estado /* = $eestado */;
        $this->id /* = $eestado */;
        $this->area /* = $eestado */;
        $this->sueldo /* = $eestado */;
        $this->antiguedad /* = $eestado */;
    }
    //#endregion

    public function getEstado()
     {
         return $this->estado;
     }
 


}
