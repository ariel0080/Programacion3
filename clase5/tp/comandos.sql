CREATE TABLE `UTN`.`Proveedores` ( `Numero` INT NOT NULL AUTO_INCREMENT , `Domicilio` VARCHAR(50) NOT NULL , `Localidad` VARCHAR(80) NOT NULL , `Nombre` VARCHAR(30) NOT NULL , PRIMARY KEY (`Numero`)) ENGINE = InnoDB;
CREATE TABLE `utn`.`Productos` ( `pNumero` INT NOT NULL AUTO_INCREMENT ,  `pNombre` VARCHAR(30) NOT NULL ,  `Precio` FLOAT NOT NULL ,  `Tamaño` VARCHAR(20) NOT NULL ,    PRIMARY KEY  (`pNumero`)) ENGINE = InnoDB;
CREATE TABLE `utn`.`Envios​` ( `Numero` INT NOT NULL ,  `pNumero` INT NOT NULL ,  `Cantidad` INT NOT NULL ,    PRIMARY KEY  (`Numero`, `pNumero`)) ENGINE = InnoDB


INSERT INTO `productos`(`pNombre`, `Precio`, `Tamaño`)
VALUES ([Caramelos],[1,5],[Chico]);

("Caramelos", 1.5, "Chico"),
("Cigarrillos", 45.89, "Mediano"),
("Gaseosa", 15.8, "Grande")


INSERT INTO `proveedores`(  `Nombre`, `Domicilio`, `Localidad`)
 VALUES ("Perez" ,"Perón 876", "Quilmes")
  ("Gimenez","Mitre 750", "Avellaneda")
  ("Aguirre ","Boedo 634 ","Bernal")


INSERT INTO `envios​`(`Numero`, `pNumero`, `Cantidad`) VALUES ([value-1],[value-2],[value-3])

  100 1 500
100 2 1500
100 3 100
101 2 55
101 3 225
102 1 600
102 3 300