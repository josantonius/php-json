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
- [Clases disponibles](#clases-disponibles)
  - [Clase Json](#clase-json)
- [Excepciones utilizadas](#excepciones-utilizadas)
- [Uso](#uso)
- [Tests](#tests)
- [Tareas pendientes](#tareas-pendientes)
- [Registro de cambios](#registro-de-cambios)
- [Contribuir](#contribuir)
- [Patrocinar](#patrocinar)
- [Licencia](#licencia)

---

## Requisitos

- Sistema operativo: Linux.

- Versiones de PHP: 8.0 | 8.1 | 8.2.

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

## Clases disponibles

### Clase Json

`Josantonius\Json\Json`

Comprueba si existe un archivo local o remoto.

```php
public function exists(): bool;
```

Obtener el contenido del archivo JSON:

```php
/**
 * @throws GetFileException   if there is an error when getting a file.
 * @throws JsonErrorException if there is an error when parsing a JSON file.
 */
public function get(): array;
```

Obtiene la ruta o URL del archivo JSON.

```php
public function filepath(): string;
```

Establecer el contenido del archivo JSON:

```php
/**
 * @throws CreateFileException        if there is an error when creating a file.
 * @throws CreateDirectoryException   if the directory cannot be created.
 * @throws UnavailableMethodException if the method is not available.
 */
public function set(array|object $content = []): void;
```

Fusionar en el archivo JSON:

```php
/**
 * @throws GetFileException           if there is an error when getting a file.
 * @throws JsonErrorException         if there is an error when parsing a JSON file.
 * @throws UnavailableMethodException if the method is not available.
 */
public function merge(array|object $content): array;
```

Incluir en el archivo JSON:

```php
/**
 * @throws GetFileException           if there is an error when getting a file.
 * @throws JsonErrorException         if there is an error when parsing a JSON file.
 * @throws UnavailableMethodException if the method is not available.
 */
public function push(array|object $content): array;
```

## Excepciones utilizadas

```php
use Josantonius\Json\Exceptions\GetFileException;
use Josantonius\Json\Exceptions\CreateFileException;
use Josantonius\Json\Exceptions\JsonErrorException;
use Josantonius\Json\Exceptions\CreateDirectoryException;
use Josantonius\Json\Exceptions\UnavailableMethodException;
```

## Uso

Ejemplo de uso para esta biblioteca:

### Comprueba si existe un archivo local

**`index.php`**

```php
use Josantonius\Json\Json;

$json = new Json('file.json');

$json->exists(); // bool
```

### Comprueba si existe un archivo remoto

**`index.php`**

```php
use Josantonius\Json\Json;

$json = new Json('https://example.com/file.json');

$json->exists(); // bool
```

### Obtener el contenido del archivo

**`file.json`**

```json
{
    "foo": "bar"
}
```

**`index.php`**

```php
use Josantonius\Json\Json;

$json = new Json('file.json');

$json->get(); // ['foo' => 'bar']
```

### Obtener el contenido del archivo desde una URL

**`https://example.com/file.json`**

```json
{
    "foo": "bar"
}
```

**`index.php`**

```php
use Josantonius\Json\Json;

$json = new Json('https://example.com/file.json');

$json->get(); // ['foo' => 'bar']
```

### Obtiene la ruta del archivo JSON

**`index.php`**

```php
use Josantonius\Json\Json;

$json = new Json('file.json');

$json->filepath(); // 'file.json'
```

### Obtiene la URL del archivo JSON remoto

**`index.php`**

```php
use Josantonius\Json\Json;

$json = new Json('https://example.com/file.json');

$json->filepath(); // 'https://example.com/file.json'
```

### Establecer una matriz vacía en el contenido del archivo JSON

**`index.php`**

```php
use Josantonius\Json\Json;

$json = new Json('file.json');

$json->set();
```

**`file.json`**

```json
[]
```

### Establecer el contenido del archivo

**`index.php`**

```php
use Josantonius\Json\Json;

$json = new Json('file.json');

$json->set(['foo' => 'bar']);
```

**`file.json`**

```json
{
    "foo": "bar"
}
```

### Fusionar en el archivo

**`file.json`**

```json
{
    "foo": "bar"
}
```

**`index.php`**

```php
use Josantonius\Json\Json;

$json = new Json('file.json');

$json->merge(['bar' => 'foo']);
```

**`file.json`**

```json
{
    "foo": "bar",
    "bar": "foo"
}
```

### Incluir en el archivo

**`file.json`**

```json
[
    {
        "name": "foo"
    }
]
```

**`index.php`**

```php
use Josantonius\Json\Json;

$json = new Json('file.json');

$json->push(['name'  => 'bar']);
```

**`file.json`**

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

## Tareas pendientes

- [ ] Añadir nueva funcionalidad
- [ ] Mejorar pruebas
- [ ] Mejorar documentación
- [ ] Mejorar la traducción al inglés en el archivo README
- [ ] Refactorizar código para las reglas de estilo de código deshabilitadas
(ver [phpmd.xml](phpmd.xml) y [phpcs.xml](phpcs.xml))

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
