<!-- 6- PUT-  haledoCarga.php
MODIFICAR	 A  HELADOS.TXT
paso todos los datos, modifico precio y kg -->

<?php


parse_str(file_get_contents("php://input"), $_PUT);

var_dump($_PUT);
    Pizzeria::modificarHelado($_PUT);
    echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold' <br>MODIFICAR <br> </font>";

