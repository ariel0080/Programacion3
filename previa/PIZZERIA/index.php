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
                case 'consultaPizza':
                    require_once 'manejadores/2consultarProducto.php';
                    break;
                case 'consultaFiltrado':
                    require_once 'manejadores/5listadoProducto.php';
                    break;
            }
            break;

        case "POST":
            switch (key($_POST)) {
                case 'nuevaPizza':
                    if (isset($_FILES["foto"])) {
                        require_once 'manejadores/7altaProductoConFoto.php';
                        break;
                    } else {
                        echo "dame pizza";
                        require_once 'manejadores/1productoCarga.php';
                        break;
                    }
                    break;
                case 'nuevaVenta':
                    if (isset($_FILES["foto"]))
                    {
                        require_once 'manejadores/4altaVentaConImagen.php';
                        break;
                    } 
                    
                    else 
                    {
                        require_once 'manejadores/3nuevaVenta.php';
                        break;
                    }
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