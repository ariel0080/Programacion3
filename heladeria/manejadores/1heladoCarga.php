<!-- 1- POST - > va al index HeladoCarga.php
se ingresa sabor precio tipo (crema o agua) cantidad de kg
se guardan los datos tomando el sabor y el tipo como identificador ( no se puede repetir)
---------------- se guarda en helados.txt (o csv)---------------- -->


<?php
if (isset($_POST["sabor"]) && isset( $_POST ["tipo"] ) && isset( $_POST ["cantidad"]) && isset($_POST ["precio"]))
{
    Heladeria::agregarHelado($_POST["sabor"], $_POST["tipo"], $_POST["cantidad"], $_POST["precio"]);
}
echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold' <br>Alta de Auto por POST (con imagen) <br> </font>";


/* $sabor = $_POST["sabor"];
$tipo= $_POST["tipo"];
$cantidad= $_POST["cantidad"];
$precio= $_POST["precio"];

    $lista = Heladeria::LeerJSON("./archivos/helados.txt", "helado");
    $helado = Heladeria::existeHelado($lista, $sabor, $tipo);

    if ($helado == null) {

        $nuevoHelado = new Helado($sabor, $tipo, $cantidad, $precio);
        array_push($lista, $nuevoHelado);

        Heladeria::guardarJsonHeladeria($lista, "./archivos/helados.txt", "helado");
    }
 */
