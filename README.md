#Customers app

### Configuración

**1 -** Una vez clonado el repositorio en su local, realizar la instalación de dependencias con `composer install`

**2 -** Crear una nueva base de datos en su local con el nombre **mydb**

**3 -** Ejecutar migraciones para la tabla de usuarios `php artisan migrate`

**4 -** Ejecutar el siguiente código sql en algún motor de bases de datos (ejem: DBeaver) para crear las tablas de la app

```

USE `mydb` ;
---------------------
-- Table `mydb`.`regions`
---------------------
DROP TABLE IF EXISTS `mydb`.`regions` ;
CREATE TABLE IF NOT EXISTS `mydb`.`regions` (

`id_reg` INT NOT NULL AUTO_INCREMENT COMMENT '', `description` VARCHAR(90)
NOT NULL COMMENT '',
`status` ENUM('A', 'I', 'trash') NOT NULL DEFAULT 'A' COMMENT '', PRIMARY KEY
(`id_reg`) COMMENT '')
ENGINE = MyISAM;
---------------------
-- Table `mydb`.`communes`
---------------------
DROP TABLE IF EXISTS `mydb`.`communes` ;
CREATE TABLE IF NOT EXISTS `mydb`.`communes` (

`id_com` INT NOT NULL AUTO_INCREMENT COMMENT '', `id_reg` INT NOT NULL
COMMENT '',
`description` VARCHAR(90) NOT NULL COMMENT '',
`status` ENUM('A', 'I', 'trash') NOT NULL DEFAULT 'A' COMMENT '', PRIMARY KEY
(`id_com`, `id_reg`) COMMENT '',
INDEX `fk_communes_region_idx` (`id_reg` ASC) COMMENT '')
ENGINE = MyISAM;
---------------------
-- Table `mydb`.`customers`
---------------------
DROP TABLE IF EXISTS `mydb`.`customers` ;
CREATE TABLE IF NOT EXISTS `mydb`.`customers` (

`dni` VARCHAR(45) NOT NULL COMMENT 'Documento de Identidad',
`id_reg` INT NOT NULL COMMENT '',
`id_com` INT NOT NULL COMMENT '',
`email` VARCHAR(120) NOT NULL COMMENT 'Correo Electrónico',
`name` VARCHAR(45) NOT NULL COMMENT 'Nombre',
`last_name` VARCHAR(45) NOT NULL COMMENT 'Apellido',
`address` VARCHAR(255) NULL COMMENT 'Dirección',
`date_reg` DATETIME NOT NULL COMMENT 'Fecha y hora del registro',
`status` ENUM('A', 'I', 'trash') NOT NULL DEFAULT 'A' COMMENT 'estado del registro:\nA
: Activo\nI : Desactivo\ntrash : Registro eliminado',
PRIMARY KEY (`dni`, `id_reg`, `id_com`) COMMENT '',
INDEX `fk_customers_communes1_idx` (`id_com` ASC, `id_reg` ASC) COMMENT '',
UNIQUE INDEX `email_UNIQUE` (`email` ASC) COMMENT '')
ENGINE = MyISAM;

```

**5 -** Crear un archivo .env con el siguiente contenido

```
APP_NAME=Laravel
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mydb
DB_USERNAME=root
DB_PASSWORD=

```

**6 -** Ejecutar comando para generar llave de la app `php artisan key:generate`

**7 -** Ejecutar comando para generar llave secreta para jwt `php artisan jwt:secret`

**8 -** Ejecutar comando para crear usuario default para autenticación y uso de los servicios `php artisan db:seed`

**9 -** Ejecutar servidor de la app con `php artisan serve`
