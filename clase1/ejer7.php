<?php

echo date("Y")."<br>";
echo date("M-D-Y")."<br>";
echo date("d/m/y")."<br>";
echo date("d/m")."<br>"."<br>"."<br>";

if(date("m") >=1 && date("m") <=3 ) 
{
	print("vareano");
}
else if(date("m") >=4 && date("m") <=6 ) 
{
	
	print("ohtanga");
}
else if(date("m") >=7 && date("m") <=8 ) 
{
print("enverno");
}
else if(date("m") >=9 && date("m") <=12 ) 
{
	print("prima verga");
}

?>