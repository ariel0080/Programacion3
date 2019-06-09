se ingresa tipo y sabor, si existe, devuele un “ si, hay!”
si no hay, pero hay el sabor y no el tipo, se avisa q hay sabor pero no tipo


---------------- se guarda en helados.txt (o csv)----------------


<?php

echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold' <br>CONUSLTAR HELADO <br> </font>";
echo $_GET["consultaHelado"];
Heladeria::ListarTodo('helado');

