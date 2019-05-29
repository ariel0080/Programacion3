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

    <!-- 
    Aplicación Nº 2 (Usuario-Login)
caso 1 alta por POST: Se ingresan los siguientes datos del usuario : mail , clave, alias y se
guarda la fecha tomada del sistema.
se guarda en un archivo de un json por renglón (usuarios.txt).
caso 2 login por POST: Se ingresan los datos de mail y clave , si existe se muestra un mensaje
de bienvenida y se guarda en el archivo “log.csv “ el alias, mail y fecha del sistema de login .
caso 3 por GET:Se pide los usuario y se muestra el listado.
caso 4 por GET:Se pide los LOG , mostrando todos los datos correspondientes.
caso 5 por PUT : se modifican los datos del usuario , (clave y alias)
caso 6 por DELETE : se recibe el id del usuario y se borra
crear las clase correspondientes.
Todas las peticiones HTTP deben ir al index.php -->

    <?php
    require_once 'login.php';

    date_default_timezone_set('America/Argentina/Buenos_Aires');

    $metodo = $_SERVER['REQUEST_METHOD'];
    echo $metodo . "<br>";
    switch ($metodo) {
        case "GET":
            switch (key($_GET)) {
                case 'Listado':
                    echo "Mostrar Lista<br>";
                    LogIn::MostrarTodos();
                    break;
                case "Log":
                    echo "<p>Mostrar Logueados</p>";
                    LogIn::MostrarLogueados();
                    break;
            }
            break;

        case "POST":
            switch (key($_POST)) {
                case 'Alta':
                    echo "Entro Al CASE de alta";
                    LogIn::altaUsuario($_POST["alias"], $_POST["clave"], $_POST["mail"]);
                    break;

                case "Ingreso":
                    echo "Entro Al CASE de LOG";
                    LogIn::altaLog($_POST["alias"], $_POST["clave"]);
                    break;
            }
            break;

        case "DELETE":
            echo "se recibe el id del usuario y se borra";
            break;

        case "PUT":
            echo "se modifican los datos del usuario , (clave y alias)";
            parse_str(file_get_contents("php://input"), $_PUT);
            var_dump($_PUT);
             LogIn::modificarUsuario($_PUT);
            break;
    }     ?>

</body>

</html>