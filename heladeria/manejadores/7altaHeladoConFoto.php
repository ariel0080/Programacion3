
7- POST alta helado con foto
carpeta /fotosHelados

<?php
echo "<font size='3' color='blue'  face='verdana' style='font-weight:bold' <br>Alta de Helado con FOTO(con imagen) <br> </font>";
Heladeria::agregarHeladoConFoto($_POST["sabor"],$_POST["tipo"],$_POST["cantidad"],$_POST["precio"],$_FILES["foto"]);

