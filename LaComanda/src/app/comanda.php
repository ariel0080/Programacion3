<?php
namespace App\Models\ORM;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require_once 'empleado.php';
require_once 'socio.php';
require_once 'persona.php';

class Comanda extends \Illuminate\Database\Eloquent\Model {

    private $socios;
    private $empleados;
    private $ventas;
    private $nombre;

    //#region Constructores
    function __construct($enombre)
    {
        $this->nombre= $enombre;
        $this->socios = array();
        $this->empleados = array();
        $this->ventas= array();      
    }
    //#endregion


}
