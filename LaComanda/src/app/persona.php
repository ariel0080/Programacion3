<?php


class Persona {

    private $nombre;
    private $apellido;
    private $dni;
    private $edad;

        //#region Constructores
        function __construct($enombre, $eapellido, $edni, $eedad)
        {
            $this->nombre= $enombre;
            $this->apellido = $eapellido;
            $this->dni = $edni;
            $this->edad= $eedad;
          
        }
        //#endregion

         //#region GETTER SETTERS
     public function getNombre()
     {
         return $this->nombre;
     }
     public function getApellido()
     {
         return $this->apellido;
     }
     public function getDni()
     {
         return $this->dni;
     }
     public function getEdad()
     {
         return $this->edad;
     }
     
     public function setApellido($var)
     {
         $this->apellido= $var;
     }
 
     public function setNombre($var)
     {
         $this->nombre = $var;
     }
     public function setDni($var)
     {
         $this->dni = $var;
     }
     public function setEdad($var)
     {
         $this->edad = $var;
     }
     
     //#endregion


}
