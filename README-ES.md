# PHP Json library

[![Latest Stable Version](https://poser.pugx.org/josantonius/Json/v/stable)](https://packagist.org/packages/josantonius/Json) [![Latest Unstable Version](https://poser.pugx.org/josantonius/Json/v/unstable)](https://packagist.org/packages/josantonius/Json) [![License](https://poser.pugx.org/josantonius/Json/license)](LICENSE) [![Codacy Badge](https://api.codacy.com/project/badge/Grade/ff3e82fba0d44889bc5ae211cffddb72)](https://www.codacy.com/app/Josantonius/PHP-Json?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=Josantonius/PHP-Json&amp;utm_campaign=Badge_Grade) [![Total Downloads](https://poser.pugx.org/josantonius/Json/downloads)](https://packagist.org/packages/josantonius/Json) [![Travis](https://travis-ci.org/Josantonius/PHP-Json.svg)](https://travis-ci.org/Josantonius/PHP-Json) [![PSR2](https://img.shields.io/badge/PSR-2-1abc9c.svg)](http://www.php-fig.org/psr/psr-2/) [![PSR4](https://img.shields.io/badge/PSR-4-9b59b6.svg)](http://www.php-fig.org/psr/psr-4/) [![CodeCov](https://codecov.io/gh/Josantonius/PHP-Json/branch/master/graph/badge.svg)](https://codecov.io/gh/Josantonius/PHP-Json)

[English version](README.md)

Biblioteca PHP para la gestión de archivos JSON.

---

- [Requisitos](#requisitos)
- [Instalación](#instalación)
- [Métodos disponibles](#métodos-disponibles)
- [Cómo empezar](#cómo-empezar)
- [Uso](#uso)
- [Tests](#tests)
- [Manejador de excepciones](#manejador-de-excepciones)
- [Tareas pendientes](#-tareas-pendientes)
- [Contribuir](#contribuir)
- [Repositorio](#repositorio)
- [Licencia](#licencia)
- [Copyright](#copyright)

---

## Requisitos

Esta clase es soportada por versiones de **PHP 5.6** o superiores y es compatible con versiones de **HHVM 3.0** o superiores.

## Instalación 

La mejor forma de instalar esta extensión es a través de [Composer](http://getcomposer.org/download/).

Para instalar **PHP Json library**, simplemente escribe:

    $ composer require Josantonius/Json

El comando anterior sólo instalará los archivos necesarios, si prefieres **descargar todo el código fuente** puedes utilizar:

    $ composer require Josantonius/Json --prefer-source

También puedes **clonar el repositorio** completo con Git:

  $ git clone https://github.com/Josantonius/PHP-Json.git

O **instalarlo manualmente**:

Descargar [Json.php](https://raw.githubusercontent.com/Josantonius/PHP-Json/master/src/Json.php), [JsonLastError.php](https://raw.githubusercontent.com/Josantonius/PHP-Json/master/src/JsonLastError.php) y [JsonException.php](https://raw.githubusercontent.com/Josantonius/PHP-Json/master/src/Exception/JsonException.php):

    $ wget https://raw.githubusercontent.com/Josantonius/PHP-Json/master/src/Json.php
    $ wget https://raw.githubusercontent.com/Josantonius/PHP-Json/master/src/JsonLastError.php
    $ wget https://raw.githubusercontent.com/Josantonius/PHP-Json/master/src/Exception/JsonException.php

## Métodos disponibles

Métodos disponibles en esta biblioteca:

### - Crear archivo JSON desde array:

```php
Json::arrayToFile($array, $file);
```

| Atributo | Descripción | Tipo | Requerido | Predeterminado
| --- | --- | --- | --- | --- |
| $array | Array a guardar en archivo JSON. | array | Sí | |
| $file | Ruta hacia el archivo. | string | Sí | |

**# Return** (boolean)

### - Guardar en array el contenido de archivo JSON:

```php
Json::fileToArray($file);
```

| Atributo | Descripción | Tipo | Requerido | Predeterminado
| --- | --- | --- | --- | --- |
| $file | Ruta o URL externa al archivo JSON. | string | Sí | |

**# Return** (array|false)

### - Comprobar si hay errores:

```php
JsonLastError::check();
```

**# Return** (array|null) → Null si no hay errores o array con código de estado y mensaje de error.

### - Obtener recopilación de posibles errores:

```php
JsonLastError::getCollection();
```

**# Return** (array) → Recopilación de posibles errores.

## Cómo empezar

Para utilizar esta biblioteca con **Composer**:

```php
require __DIR__ . '/vendor/autoload.php';

use Josantonius\Json\Json;
```

Si la instalaste **manualmente**, utiliza:

```php
require_once __DIR__ . '/Json.php';
require_once __DIR__ . '/JsonLastError.php';
require_once __DIR__ . '/JsonException.php';

use Josantonius\Json\Json;
```

## Uso

Ejemplo de uso para esta biblioteca:

### - Crear archivo JSON desde array:

```php

$array = [
	'name'  => 'Josantonius',
    'email' => 'info@josantonius.com',
    'url'   => 'https://github.com/josantonius/PHP-Json'
];

$pathfile = __DIR__ . '/filename.json';

Json::arrayToFile($array, $pathfile);

```

### - Guardar en array el contenido de archivo JSON:

```php
$pathfile = __DIR__ . '/filename.json';

$array = Json::fileToArray($pathfile);

```

### - Comprobar si hay errores:

```php
$lastError = JsonLastError::check();

if (!is_null($lastError)) {
    var_dump($lastError);
}
```

### - Obtener recopilación de posibles errores:

```php
$jsonLastErrorCollection = JsonLastError::getCollection();
```

## Tests 

Para ejecutar las [pruebas](tests) necesitarás [Composer](http://getcomposer.org/download/) y seguir los siguientes pasos:

    $ git clone https://github.com/Josantonius/PHP-Json.git
    
    $ cd PHP-Json

    $ composer install

Ejecutar pruebas unitarias con [PHPUnit](https://phpunit.de/):

    $ composer phpunit

Ejecutar pruebas de estándares de código [PSR2](http://www.php-fig.org/psr/psr-2/) con [PHPCS](https://github.com/squizlabs/PHP_CodeSniffer):

    $ composer phpcs

Ejecutar pruebas con [PHP Mess Detector](https://phpmd.org/) para detectar inconsistencias en el estilo de codificación:

    $ composer phpmd

Ejecutar todas las pruebas anteriores:

    $ composer tests

## Manejador de excepciones

Esta biblioteca utiliza [control de excepciones](src/Exception) que puedes personalizar a tu gusto.

## ☑ Tareas pendientes

- [ ] Añadir nueva funcionalidad
- [ ] Mejorar pruebas
- [ ] Mejorar documentación
- [ ] Refactorizar código

## Contribuir

Si deseas colaborar, puedes echar un vistazo a la lista de
[issues](https://github.com/Josantonius/PHP-Json/issues) o [tareas pendientes](#-tareas-pendientes).

**Pull requests**

* [Fork and clone](https://help.github.com/articles/fork-a-repo).
* Ejecuta el comando `composer install` para instalar dependencias.
  Esto también instalará las [dependencias de desarrollo](https://getcomposer.org/doc/03-cli.md#install).
* Ejecuta el comando `composer fix` para estandarizar el código.
* Ejecuta las [pruebas](#tests).
* Crea una nueva rama (**branch**), **commit**, **push** y envíame un
  [pull request](https://help.github.com/articles/using-pull-requests).

## Repositorio

La estructura de archivos de este repositorio se creó con [PHP-Skeleton](https://github.com/Josantonius/PHP-Skeleton).

## Licencia

Este proyecto está licenciado bajo **licencia MIT**. Consulta el archivo [LICENSE](LICENSE) para más información.

## Copyright

2016 - 2018 Josantonius, [josantonius.com](https://josantonius.com/)

Si te ha resultado útil, házmelo saber :wink:

Puedes contactarme en [Twitter](https://twitter.com/Josantonius) o a través de mi [correo electrónico](mailto:hello@josantonius.com).