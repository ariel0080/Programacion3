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
    require_once './clases/pizzeria.php';

    date_default_timezone_set('America/Argentina/Buenos_Aires');

    $metodo = $_SERVER['REQUEST_METHOD'];

    echo $metodo;

    switch ($metodo) {
        case "GET":
            switch (key($_GET)) {
                case 'cargaPizza':
                    echo " empieza carga";
                    require_once 'manejadores/PizzaCarga.php';
                    break;
            }
            break;

        case "POST":
            switch (key($_POST)) {
                case 'consultarPizza':
                    require_once 'manejadores/PizzaConsultar.php';
                    break;
            }
            break;

        case "PUT":
            require_once 'manejadores/6modificarProducto.php';
            break;
        case "DELETE":
            require_once 'manejadores/8borrarProducto.php';
            break;
    }

    ?>

</body>

</html>