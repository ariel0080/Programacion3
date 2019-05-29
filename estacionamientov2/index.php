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
    require_once "./recursos/upload.php";
    
    date_default_timezone_set('America/Argentina/Buenos_Aires');

    $metodo = $_SERVER['REQUEST_METHOD'];
    echo $metodo . "<br>";
    switch ($metodo) {
        case "GET":
            switch (key($_GET)) {
                case 'estacionados':
                    Estacionamiento::MostrarEstacionas();
                    break;
                    Estacionamiento::MostrarFacturado();
                    break;
            }
            break;
        case "POST":
            switch (key($_POST)) {
                case 'autoIngresado':
                echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold' <br>Alta de Auto por POST (con imagen) <br> </font>";
                    Estacionamiento::vehiculoEstacionado($_FILES["foto"], $_POST["autoIngresado"]);        
                    break;
                case "autoSaliendo":
                echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold' <br>Baja de Auto por POST y facturado <br> </font>";
                    Estacionamiento::removervehiculoEstacionado($_POST["autoSaliendo"]);
                    break;
            }
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