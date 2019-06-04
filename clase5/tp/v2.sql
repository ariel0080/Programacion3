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
SELECT * FROM `provedores​` WHERE localidad='Quilmes'

3.
SELECT * FROM `envios` WHERE cantidad BETWEEN 200 AND 300

4.
SELECT SUM(cantidad) AS 'cantidad total de productos enviados' FROM envios a

5.
SELECT * FROM envios a ORDER BY a.pNumero LIMIT 3

6. // no funciono //
SELECT provedores.nombre, productos.pNombre FROM provedores, productos, envios WHERE provedores.numero = envios.numero AND productos.pNumero = envios.pNumero
OTRA
SELECT pro.pNombre, prov.Nombre FROM productos AS pro INNER JOIN envios AS en ON pro.pNumero = en.pnumero INNER JOIN provedores AS prov ON en.numero = prov.numero
///////////////

7.
SELECT
    provee.*,
    produc.*,
    envi.cantidad,
    (cantidad * precio) AS 'Monto de envios'
FROM
    provedores AS provee,
    productos AS produc,
    envios AS envi
WHERE
    provee.numero = envi.numero AND produc.pNumero = envi.pNumero

8.
SELECT SUM(cantidad) 'Cantidad total' FROM envios env WHERE env.pNumero = 1 AND env.numero = 102

9.
SELECT produc.pNumero FROM provedores proveed, productos produc, envios envi WHERE produc.pNumero = envi.pNumero AND proveed.numero = envi.numero AND proveed.localidad = 'Avellaneda'

10.
SELECT provedores.domicilio, provedores.localidad FROM provedores WHERE nombre LIKE '%i%'

11.
INSERT INTO productos(pNombre, precio, tamaño)
VALUES('Chocolate', '25.35', 'Chico')

12.
INSERT INTO provedores() VALUES()

13.
INSERT INTO provedores (numero, nombre, localidad) VALUES (107, 'Rosales', 'La Plata')

14.
UPDATE productos SET precio = 97.50 WHERE tamaño = 'grande'

15.
UPDATE productos SET tamaño = 'Mediano' WHERE tamaño = 'Chico' AND pNumero IN( SELECT DISTINCT productos.pNumero FROM envios envi WHERE productos.pNumero = envi.pNumero AND envi.cantidad >= 300 AND productos.tamaño = 'Chico' )

16.
DELETE FROM productos WHERE pNumero = 1

17.
consulta 
SELECT * FROM provedores WHERE NOT EXISTS ( SELECT 1 FROM envios WHERE envios.numero = provedores.numero )
DELETE FROM provedores WHERE NOT EXISTS ( SELECT 1 FROM envios WHERE envios.numero = provedores.numero )

