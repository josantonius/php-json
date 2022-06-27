# PHP JSON library

[![Latest Stable Version](https://poser.pugx.org/josantonius/Json/v/stable)](https://packagist.org/packages/josantonius/json)
[![License](https://poser.pugx.org/josantonius/json/license)](LICENSE)
[![Total Downloads](https://poser.pugx.org/josantonius/json/downloads)](https://packagist.org/packages/josantonius/json)
[![CI](https://github.com/josantonius/php-json/actions/workflows/ci.yml/badge.svg?branch=main)](https://github.com/josantonius/php-json/actions/workflows/ci.yml)
[![CodeCov](https://codecov.io/gh/josantonius/php-json/branch/main/graph/badge.svg)](https://codecov.io/gh/josantonius/php-json)
[![PSR1](https://img.shields.io/badge/PSR-1-f57046.svg)](https://www.php-fig.org/psr/psr-1/)
[![PSR4](https://img.shields.io/badge/PSR-4-9b59b6.svg)](https://www.php-fig.org/psr/psr-4/)
[![PSR12](https://img.shields.io/badge/PSR-12-1abc9c.svg)](https://www.php-fig.org/psr/psr-12/)

**Traducciones**: [English](/README.md)

Biblioteca PHP para la gestión de archivos JSON.

---

- [Requisitos](#requisitos)
- [Instalación](#instalación)
- [Métodos disponibles](#métodos-disponibles)
- [Cómo empezar](#cómo-empezar)
- [Uso](#uso)
- [Tests](#tests)
- [Tareas pendientes](#☑-tareas-pendientes)
- [Registro de cambios](#registro-de-cambios)
- [Contribuir](#contribuir)
- [Patrocinar](#patrocinar)
- [Licencia](#licencia)

---

## Requisitos

Esta biblioteca es compatible con las versiones de PHP: 8.0 | 8.1.

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

## Métodos disponibles

Métodos disponibles en esta biblioteca:

### Obtener el contenido del archivo JSON

```php
$json->get();
```

**@throws** `CreateDirectoryException` Si no se puede crear el directorio

**@throws** `CreateFileException` Si no se puede crear el archivo

**@throws** `JsonErrorException` Si hay un error al analizar un archivo JSON

**@Return** `array` Contenido del archivo

### Establecer el contenido del archivo JSON

```php
$json->set(array|object $content);
```

**@throws** `CreateFileException` Si no se puede crear el archivo

**@throws** `JsonErrorException` Si hay un error al analizar un archivo JSON

**@throws** `UnavailableMethodException` Si el método no está disponible

**@Return** `void`

### Fusionar en el archivo JSON

```php
$json->merge(array|object $content);
```

**@throws** `CreateFileException` Si no se puede crear el archivo

**@throws** `GetFileException` Si no se puede obtener el archivo

**@throws** `JsonErrorException` Si hay un error al analizar un archivo JSON

**@throws** `UnavailableMethodException` Si el método no está disponible

**@Return** `array` Array resultante

### Incluir en el archivo JSON

```php
$json->push(array|object $content);
```

**@throws** `CreateFileException` Si no se puede crear el archivo

**@throws** `GetFileException` Si no se puede obtener el archivo

**@throws** `JsonErrorException` Si hay un error al analizar un archivo JSON

**@throws** `UnavailableMethodException` Si el método no está disponible

**@Return** `array` Array resultante

## Cómo empezar

Para utilizar esta biblioteca con **Composer**:

```php
require __DIR__ . '/vendor/autoload.php';

use josantonius\Json\Json;
```

```php
$json = new Json('path/to/file.json');

# Si el archivo no existe, se creará.
```

O

```php
$json = new Json('https://site.com/file.json');

# Cuando el archivo JSON se obtiene desde una URL, sólo estará disponible el método "get".
```

## Uso

Ejemplo de uso para esta biblioteca:

### Obtener el contenido del archivo

```json
{
    "foo": "bar"
}
```

```php
$json->get();
```

```php
['foo' => 'bar']
```

### Establecer el contenido del archivo

```php
$json->set(['foo' => 'bar']);
```

```json
{
    "foo": "bar"
}
```

### Fusionar en el archivo

```json
{
    "foo": "bar"
}
```

```php
$json->merge(['bar' => 'foo']);
```

```json
{
    "foo": "bar",
    "bar": "foo"
}
```

### Incluir en el archivo

```json
[
    {
        "name": "foo"
    }
]
```

```php
$json->push(['name'  => 'bar']);
```

```json
[
    {
        "name": "foo"
    },
    {
        "name": "bar"
    }
]
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

Ejecutar pruebas de estándares de código con [PHPCS](https://github.com/squizlabs/PHP_CodeSniffer):

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
[puedes patrocinarme](https://github.com/josantonius/lang/es-ES/README.md#patrocinar)
para apoyar mi trabajo :blush:

## Licencia

Este repositorio tiene una licencia [MIT License](LICENSE).

Copyright © 2016-actualidad, [Josantonius](https://github.com/josantonius/lang/es-ES/README.md#contacto)
