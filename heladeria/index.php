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
    require_once './clases/heladeria.php';
    require_once "./recursos/upload.php";

    date_default_timezone_set('America/Argentina/Buenos_Aires');

    $metodo = $_SERVER['REQUEST_METHOD'];
    echo $metodo . "<br>";
    switch ($metodo) 
    {
      case "GET":
            switch (key($_GET)) {
                case 'consultaHelado':
                    require_once 'manejadores/2consultarHelado.php';
                    break;
                case 'consultaFiltrado':
                    require_once 'manejadores/5listadoSabor.php';
                    break;
            }
            break; 

        case "POST":
            switch (key($_POST)) {
                case 'nuevoHelado':
                    echo "Alta Helado";
                    require_once 'manejadores/1heladoCarga.php';
                    break;
                case 'nuevoHeladoConImagen':
                    echo "nueva Venta Con Imagen";
                    require_once 'manejadores/4altaVentaConImagen.php';
                    break;
                case 'nuevoVenta':
                    echo "nuevaVenta";
                    require_once 'manejadores/3nuevaVenta.php';
                    break;
                case 'nuevoVentaConImagen':
                    echo "nueva Venta Con Imagen";
                    require_once 'manejadores/4altaVentaConImagen.php';
                    break;
            }
            break;

        case "PUT":
            echo "Modificar Helado";
            require_once 'manejadores/7altaHeladoConFoto.php';
            break;
        case "DELETE":
            echo "Borrar Helado";
            require_once 'manejadores/8borrarHelado.php';
            break;
    }     
    
    ?>

</body>

</html>