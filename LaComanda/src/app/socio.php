<?php

class Socio extends Persona
{

    private $estado;

    //#region Constructores
    function __construct($enombre, $eapellido, $edni, $eedad, $eestado)
    {
        parent::__construct($enombre, $eapellido, $edni, $eedad);
        $this->estado = $eestado;
    }
    //#endregion

    public function getEstado()
     {
         return $this->estado;
     }
 

}
