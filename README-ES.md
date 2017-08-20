# PHP Json library

[![Latest Stable Version](https://poser.pugx.org/josantonius/json/v/stable)](https://packagist.org/packages/josantonius/json) [![Total Downloads](https://poser.pugx.org/josantonius/json/downloads)](https://packagist.org/packages/josantonius/json) [![Latest Unstable Version](https://poser.pugx.org/josantonius/json/v/unstable)](https://packagist.org/packages/josantonius/json) [![License](https://poser.pugx.org/josantonius/json/license)](https://packagist.org/packages/josantonius/json)

[English version](README.md)

Biblioteca PHP para la gestión de archivos JSON.

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
- [Licencia](#licencia)
- [Copyright](#copyright)

---

<p align="center"><strong>Echa un vistazo al código</strong></p>

<p align="center">
  <a href="https://youtu.be/5Tpx-iZ8ktA" title="Echa un vistazo al código">
  	<img src="https://raw.githubusercontent.com/Josantonius/PHP-Algorithm/master/resources/youtube-thumbnail.jpg">
  </a>
</p>

---

### Instalación 

La mejor forma de instalar esta extensión es a través de [composer](http://getcomposer.org/download/).

Para instalar PHP Json library, simplemente escribe:

    $ composer require Josantonius/Json

El comando anterior sólo instalará los archivos necesarios, si prefieres descargar todo el código fuente (incluyendo tests, directorio vendor, excepciones no utilizadas, documentos...) puedes utilizar:

    $ composer require Josantonius/Json --prefer-source

También puedes clonar el repositorio completo con Git:

	$ git clone https://github.com/Josantonius/PHP-Json.git

### Requisitos

Esta ĺibrería es soportada por versiones de PHP 5.6 o superiores y es compatible con versiones de HHVM 3.0 o superiores.

### Cómo empezar y ejemplos

Para utilizar esta biblioteca, simplemente:

```php
require __DIR__ . '/vendor/autoload.php';

use Josantonius\Json\Json;
```
### Métodos disponibles

Métodos disponibles en esta biblioteca:

```php
Json::arrayToFile();
Json::fileToArray();
```
### Uso

Ejemplo de uso para esta biblioteca:

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

var_dump(Json::arrayToFile($array, $pathfile)); //bool(true)

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
Métodos de prueba disponibles en esta biblioteca:

```php
JsonTest::testArrayToFile();
JsonTest::testArrayToFileError();
JsonTest::testFileToArray();
JsonTest::testFileToArrayError();
```

### Manejador de excepciones

Esta biblioteca utiliza [control de excepciones](src/Exception) que puedes personalizar a tu gusto.
### Contribuir
1. Comprobar si hay incidencias abiertas o abrir una nueva para iniciar una discusión en torno a un fallo o función.
1. Bifurca la rama del repositorio en GitHub para iniciar la operación de ajuste.
1. Escribe una o más pruebas para la nueva característica o expón el error.
1. Haz cambios en el código para implementar la característica o reparar el fallo.
1. Envía pull request para fusionar los cambios y que sean publicados.

Esto está pensado para proyectos grandes y de larga duración.

### Repositorio

Los archivos de este repositorio se crearon y subieron automáticamente con [Reposgit Creator](https://github.com/Josantonius/BASH-Reposgit).

### Licencia

Este proyecto está licenciado bajo **licencia MIT**. Consulta el archivo [LICENSE](LICENSE) para más información.

### Copyright

2017 Josantonius, [josantonius.com](https://josantonius.com/)

Si te ha resultado útil, házmelo saber :wink:

Puedes contactarme en [Twitter](https://twitter.com/Josantonius) o a través de mi [correo electrónico](mailto:hello@josantonius.com).