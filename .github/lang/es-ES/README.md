# PHP JSON library

[![Latest Stable Version](https://poser.pugx.org/josantonius/Json/v/stable)](https://packagist.org/packages/josantonius/json)
[![License](https://poser.pugx.org/josantonius/json/license)](LICENSE)
[![Total Downloads](https://poser.pugx.org/josantonius/json/downloads)](https://packagist.org/packages/josantonius/json)
[![CI](https://github.com/josantonius/php-json/actions/workflows/ci.yml/badge.svg?branch=main)](https://github.com/josantonius/php-json/actions/workflows/ci.yml)
[![PSR2](https://img.shields.io/badge/PSR-2-1abc9c.svg)](http://www.php-fig.org/psr/psr-2/)
[![PSR4](https://img.shields.io/badge/PSR-4-9b59b6.svg)](http://www.php-fig.org/psr/psr-4/)
[![CodeCov](https://codecov.io/gh/josantonius/php-json/branch/master/graph/badge.svg)](https://codecov.io/gh/josantonius/php-json)

**Traducciones**: [English](/README.md)

Biblioteca PHP para la gestión de archivos JSON.

---

- [Requisitos](#requisitos)
- [Instalación](#instalación)
- [Métodos disponibles](#métodos-disponibles)
- [Cómo empezar](#cómo-empezar)
- [Uso](#uso)
- [Tests](#tests)
- [Manejo de excepciones](#manejo-de-excepciones)
- [Tareas pendientes](#☑-tareas-pendientes)
- [Registro de cambios](#registro-de-cambios)
- [Contribuir](#contribuir)
- [Patrocinar](#patrocinar)
- [Licencia](#licencia)

---

## Requisitos

Esta biblioteca es compatible con las versiones de PHP:
**5.6** | **7.0** | **7.1** | **7.2** | **7.3** | **7.4**.

## Instalación

La mejor forma de instalar esta extensión es a través de [Composer](http://getcomposer.org/download/).

Para instalar **PHP Json library**, simplemente escribe:

```console
composer require josantonius/json
```

El comando anterior sólo instalará los archivos necesarios,
si prefieres **descargar todo el código fuente** puedes utilizar:

```console
composer require josantonius/json --prefer-source
```

También puedes **clonar el repositorio** completo con Git:

```console
git clone https://github.com/josantonius/php-json.git
```

O **instalarlo manualmente**:

Descargar [Json.php](https://raw.githubusercontent.com/josantonius/php-json/master/src/Json.php),
[JsonLastError.php](https://raw.githubusercontent.com/josantonius/php-json/master/src/JsonLastError.php) y
[JsonException.php](https://raw.githubusercontent.com/josantonius/php-json/master/src/Exception/JsonException.php):

```console
wget https://raw.githubusercontent.com/josantonius/php-json/master/src/Json.php
```

```console
wget https://raw.githubusercontent.com/josantonius/php-json/master/src/JsonLastError.php
```

```console
wget https://raw.githubusercontent.com/josantonius/php-json/master/src/Exception/JsonException.php
```

## Métodos disponibles

Métodos disponibles en esta biblioteca:

### Crear archivo JSON desde array

```php
Json::arrayToFile($array, $file);
```

| Atributo | Descripción | Tipo | Requerido | Predeterminado
| --- | --- | --- | --- | --- |
| $array | Array a guardar en archivo JSON. | array | Sí | |
| $file | Ruta hacia el archivo. | string | Sí | |

**# Return** (boolean)

### Guardar en array el contenido de archivo JSON

```php
Json::fileToArray($file);
```

| Atributo | Descripción | Tipo | Requerido | Predeterminado
| --- | --- | --- | --- | --- |
| $file | Ruta o URL externa al archivo JSON. | string | Sí | |

**# Return** (array|false)

### Comprobar si hay errores

```php
JsonLastError::check();
```

**# Return** (array|null) → Null si no hay errores o array con código de estado y mensaje de error.

### Obtener colección de errores JSON

```php
JsonLastError::getCollection();
```

**# Return** (array) → Recopilación de posibles errores.

## Cómo empezar

Para utilizar esta biblioteca con **Composer**:

```php
require __DIR__ . '/vendor/autoload.php';

use josantonius\Json\Json;
```

Si la instalaste **manualmente**, utiliza:

```php
require_once __DIR__ . '/Json.php';
require_once __DIR__ . '/JsonLastError.php';
require_once __DIR__ . '/JsonException.php';

use josantonius\Json\Json;
```

## Uso

Ejemplo de uso para esta biblioteca:

### Crear un archivo JSON desde un array

```php
$array = [
 'name'  => 'josantonius',
    'email' => 'info@josantonius.com',
    'url'   => 'https://github.com/josantonius/php-json'
];

$pathfile = __DIR__ . '/filename.json';

Json::arrayToFile($array, $pathfile);
```

### Guardar en un array el contenido de un archivo JSON

```php
$pathfile = __DIR__ . '/filename.json';

$array = Json::fileToArray($pathfile);
```

### Comprobar si hubo errores

```php
$lastError = JsonLastError::check();

if (!is_null($lastError)) {
    var_dump($lastError);
}
```

### Obtener colección con errores JSON

```php
$jsonLastErrorCollection = JsonLastError::getCollection();
```

## Tests

Para ejecutar las [pruebas](tests) necesitarás [Composer](http://getcomposer.org/download/)
y seguir los siguientes pasos:

```console
git clone https://github.com/josantonius/php-json.git
```

```console
cd php-json
```

```console
composer install
```

Ejecutar pruebas unitarias con [PHPUnit](https://phpunit.de/):

```console
composer phpunit
```

Ejecutar pruebas de estándares de código [PSR2](http://www.php-fig.org/psr/psr-2/)
con [PHPCS](https://github.com/squizlabs/PHP_CodeSniffer):

```console
composer phpcs
```

Ejecutar pruebas con [PHP Mess Detector](https://phpmd.org/) para detectar inconsistencias en el
estilo de codificación:

```console
composer phpmd
```

Ejecutar todas las pruebas anteriores:

```console
composer tests
```

## Manejo de excepciones

Esta biblioteca utiliza [control de excepciones](src/Exception) que puedes personalizar a tu gusto.

## ☑ Tareas pendientes

- [ ] Añadir nueva funcionalidad.
- [ ] Mejorar pruebas.
- [ ] Mejorar documentación.
- [ ] Mejorar la traducción al inglés en el archivo README.
- [ ] Refactorizar código para las reglas de estilo de código deshabilitadas.
Ver [phpmd.xml](phpmd.xml) y [phpcs.xml](phpcs.xml).

## Registro de cambios

Los cambios detallados de cada versión se documentan en las
[notas de la misma](https://github.com/josantonius/php-json/releases).

## Contribuir

Por favor, asegúrate de leer la [Guía de contribución](CONTRIBUTING.md) antes de hacer un
_pull request_, comenzar una discusión o reportar un _issue_.

¡Gracias por [colaborar](https://github.com/josantonius/php-json/graphs/contributors)! :heart:

## Patrocinar

Si este proyecto te ayuda a reducir el tiempo de desarrollo,
[¡puedes patrocinarme!](https://github.com/josantonius/lang/es-ES/README.md#patrocinar) :blush:

## Licencia

Este repositorio tiene una licencia [MIT License](LICENSE).

Copyright © 2016-actualidad, [Josantonius](https://github.com/josantonius/lang/es-ES/README.md#contacto)
