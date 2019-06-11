<!-- 
5 - GET 
listado filtrado por por tipo o sabor ( toca lo q toca) DE VENTAS
TRAER LA FOTO
 -->

 <?php

echo 
"<font size='3' color='blue'  
face='verdana' style='font-weight:bold' 
<br>CONSULTAR FILTRO <br> </font>";

/* if(isset($_GET["consultaFiltro"]))
 echo $_GET["consultaFiltro"]; */

 if(isset($_GET["sabor"]) || isset($_GET["tipo"]) )
 {    
     /* Heladeria::consultarHelado($_GET["sabor"], $_GET["tipo"]); */
     Heladeria::ListarVendidos($_GET["sabor"], $_GET["tipo"]);
 }
 else{
     echo "no paso nada";
 }