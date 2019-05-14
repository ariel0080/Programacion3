<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/estilos.css">

    <title>Document</title>
</head>

<body>


    <?php


    require_once "crearVehiculo.php";
    require_once "traerVehiculo.php";

    $metodo = $_SERVER['REQUEST_METHOD'];
    echo $metodo . "<br>";
    switch ($metodo) {
        case "GET":
            if ($_GET["que hacer"] == "traerTodos") {
                //llamar a metodos traer todos
            }
            break;

        case "POST":
            if ($_POST["PARAMETRO"] == "traerTodos") {
                //llamar a metodos traer todos
            }
            break;

        case "DELETE":
            if ($_POST["PARAMETRO"] == "traerTodos") {
                //llamar a metodos traer todos
            }
            break;

        case "PUT":
            if ($_POST["PARAMETRO"] == "traerTodos") {
                //llamar a metodos traer todos
            }
            break;








            ?>




    </body>

    </html>