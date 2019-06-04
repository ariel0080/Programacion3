CREATE TABLE `utn`.`Provedores​` ( `numero` INT NOT NULL AUTO_INCREMENT ,  `nombre` VARCHAR(30) NULL DEFAULT NULL ,  `domicilio` VARCHAR(50) NULL DEFAULT NULL ,  `localidad` VARCHAR(80) NULL DEFAULT NULL ,    PRIMARY KEY  (`numero`)) ENGINE = InnoDB;
CREATE TABLE `utn`.`productos` ( `pNumero` INT NOT NULL AUTO_INCREMENT ,  `pNombre` VARCHAR(30) NULL ,  `precio` FLOAT NULL ,  `tamaño` VARCHAR(20) NULL ,    PRIMARY KEY  (`pNumero`)) ENGINE = InnoDB;
CREATE TABLE `utn`.`envios` ( `numero` INT NOT NULL AUTO_INCREMENT ,  `pNumero` INT NOT NULL ,  `cantidad` INT NOT NULL ,    PRIMARY KEY  (`numero`, `pNumero`)) ENGINE = InnoDB;

INSERT INTO `provedores`(`numero`,`nombre`,`domicilio`,`localidad`)
VALUES(100, "Perez", "Perón 876", "Quilmes"),( 101, "Gimenez", "Mitre 750", "Avellaneda"),(102, "Aguirre ", "Boedo 634 ", "Bernal")

INSERT INTO `envios`(`numero`, `pNumero`, `cantidad`)
VALUES(100, 1, 500),(100, 2, 1500),(100, 3, 100),(101, 2, 55),(101, 3, 225),(102, 1, 600),(102, 3, 300)

INSERT INTO `productos`(`pNombre`, `precio`, `tamaño`)
VALUES("Caramelos", 1.5, "Chico"),("Cigarrillos", 45.89, "Mediano"),("Gaseosa", 15.8, "Grande")


1.
SELECT * FROM productos ORDER BY pNombre

2.
