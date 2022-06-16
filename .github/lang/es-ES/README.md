# PHP JSON library

[![Latest Stable Version](https://poser.pugx.org/josantonius/Json/v/stable)](https://packagist.org/packages/josantonius/json)
[![License](https://poser.pugx.org/josantonius/json/license)](LICENSE)
[![Total Downloads](https://poser.pugx.org/josantonius/json/downloads)](https://packagist.org/packages/josantonius/json)
[![CI](https://github.com/josantonius/php-json/actions/workflows/ci.yml/badge.svg?branch=main)](https://github.com/josantonius/php-json/actions/workflows/ci.yml)
[![PSR2](https://img.shields.io/badge/PSR-2-1abc9c.svg)](http://www.php-fig.org/psr/psr-2/)
[![PSR4](https://img.shields.io/badge/PSR-4-9b59b6.svg)](http://www.php-fig.org/psr/psr-4/)
[![CodeCov](https://codecov.io/gh/josantonius/php-json/branch/main/graph/badge.svg)](https://codecov.io/gh/josantonius/php-json)

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

Esta biblioteca es compatible desde la versión **8.0** de PHP hasta la versión **8.1** de PHP.

Para seguir utilizando la versión con métodos estáticos sin las nuevas características:

- Para versiones anteriores de PHP (desde la **5.6** hasta la **7.4**), puedes utilizar la
[versión 1.1.9](https://github.com/josantonius/php-json/tree/1.1.9) de esta biblioteca.

- Para las versiones **8.0** y **8.1** de PHP, puedes utilizar la
[version 1.2.0](https://github.com/josantonius/php-json/tree/1.2.0) de esta biblioteca.

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

**@throws** _CreateDirectoryException_ | _CreateFileException_ | _JsonErrorException_

**@Return** `array` - _Contenido del archivo_

### Establecer el contenido del archivo JSON

```php
$json->set(array|object $content);
```

**@throws** _CreateFileException_ | _JsonErrorException_ | _UnavailableMethodException_

**@Return** `void`

### Fusionar en el archivo JSON

```php
$json->merge(array|object $content);
```

**@throws** _CreateFileException_ | _GetFileException_ | _JsonErrorException_ | _UnavailableMethodException_

**@Return** `array` - _Array resultante_

### Incluir en el archivo JSON

```php
$json->push(array|object $content);
```

**@throws** _CreateFileException_ | _GetFileException_ | _JsonErrorException_ | _UnavailableMethodException_

**@Return** `array` - _Array resultante_

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

Si este proyecto te ayuda a reducir el tiempo de desarrollo y quieres agradecérmelo,
[¡podrías patrocinarme!](https://github.com/josantonius/lang/es-ES/README.md#patrocinar) :blush:

## Licencia

Este repositorio tiene una licencia [MIT License](LICENSE).

Copyright © 2016-actualidad, [Josantonius](https://github.com/josantonius/lang/es-ES/README.md#contacto)
