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
    require_once 'estacionamiento.php';
    require_once "crearVehiculo.php";
    require_once "traerVehiculo.php";

    $metodo = $_SERVER['REQUEST_METHOD'];
    echo $metodo . "<br>";
    switch ($metodo) {
        case "GET":
            if ($_GET["quehacer"] == "traerTodos") {

                echo "algo algo";
            }
            break;

        case "POST":

            Estacionamiento::vehiculoEstacionado($_POST["autoIngresado"]);
            echo "lolo";
            break;

        case "DELETE":
            echo "delete";
            break;

        case "PUT":
            echo "put";
            break;
    }     ?>

</body>

</html>