<?php

echo 
"<font size='3' color='blue'  
face='verdana' style='font-weight:bold' 
<br>CONSULTAR FILTRO VENTAS <br> </font>";

/* if(isset($_GET["consultaFiltro"]))
 echo $_GET["consultaFiltro"]; */

    Pizzeria::ListarVendidos($_GET["tipo"]);

