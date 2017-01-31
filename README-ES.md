# PHP Json library

[![Latest Stable Version](https://poser.pugx.org/josantonius/json/v/stable)](https://packagist.org/packages/josantonius/json) [![Total Downloads](https://poser.pugx.org/josantonius/json/downloads)](https://packagist.org/packages/josantonius/json) [![Latest Unstable Version](https://poser.pugx.org/josantonius/json/v/unstable)](https://packagist.org/packages/josantonius/json) [![License](https://poser.pugx.org/josantonius/json/license)](https://packagist.org/packages/josantonius/json)

[Spanish version](README-ES.md)

Librería PHP para la gestión de archivos JSON.

---

- [Instalación](#instalación)
- [Requisitos](#requisitos)
- [Cómo empezar y ejemplos](#cómo-empezar-y-ejemplos)
- [Métodos disponibles](#métodos-disponibles)
- [Uso](#uso)
- [Tests](#tests)
- [Manejador de excepciones](#manejador-de-excepciones)
- [Contribuir](#contribuir)
- [Repositorio](#repositorio)
- [Autor](#autor)
- [Licencia](#licencia)

---

### Instalación 

La mejor forma de instalar esta extensión es a través de [composer](http://getcomposer.org/download/).

Para instalar PHP Json library, simplemente escribe:

    $ composer require Josantonius/Json

### Requisitos

Esta ĺibrería es soportada por versiones de PHP 5.6 o superiores y es compatible con versiones de HHVM 3.0 o superiores.

### Cómo empezar y ejemplos

Para utilizar esta librería, simplemente:

```php
require __DIR__ . '/vendor/autoload.php';

use Josantonius\Json\Json;
```
### Métodos disponibles

Métodos disponibles en esta librería:

```php
Json::arrayToFile();
Json::fileToArray();
Json::jsonLastError();
```
### Uso

Ejemplo de uso para esta librería:

```php
<?php
require __DIR__ . '/vendor/autoload.php';

use Josantonius\Json\Json;

$array = [
	'name'  => 'Josantonius',
    'email' => 'info@josantonius.com',
    'url'   => 'https://github.com/josantonius/PHP-Json'
];

$pathfile = __DIR__ . '/filename.json';

var_dump(Json::arrayToFile($pathfile, $array)); //bool(true)

/* Esto creará el archivo "filename.json" en el directorio "tests". */
```

### Tests 

Para utilizar la clase de [pruebas](tests), simplemente:

```php
<?php
$loader = require __DIR__ . '/vendor/autoload.php';

$loader->addPsr4('Josantonius\\Json\\Tests\\', __DIR__ . '/vendor/josantonius/json/tests');

use Josantonius\Json\Tests\JsonTest;
```
Métodos de prueba disponibles en esta librería:

```php
JsonTest::testArrayToFile();
JsonTest::testArrayToFileError();
JsonTest::testFileToArray();
JsonTest::testFileToArrayError();
```

### Manejador de excepciones

Esta librería utiliza [control de excepciones](src/Exception) que puedes personalizar a tu gusto.
### Contribuir
1. Comprobar si hay incidencias abiertas o abrir una nueva para iniciar una discusión en torno a un fallo o función.
1. Bifurca la rama del repositorio en GitHub para iniciar la operación de ajuste.
1. Escribe una o más pruebas para la nueva característica o expón el error.
1. Haz cambios en el código para implementar la característica o reparar el fallo.
1. Envía pull request para fusionar los cambios y que sean publicados.

Esto está pensado para proyectos grandes y de larga duración.

### Repositorio

Los archivos de este repositorio se crearon y subieron automáticamente con [Reposgit Creator](https://github.com/Josantonius/BASH-Reposgit).

### Autor

Mantenido por [Josantonius](https://github.com/Josantonius/).

### Licencia

Este proyecto está licenciado bajo la **licencia MIT**. Consulta el archivo [LICENSE](LICENSE) para más información.