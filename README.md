# PHP JSON library

[![Latest Stable Version](https://poser.pugx.org/josantonius/Json/v/stable)](https://packagist.org/packages/josantonius/json)
[![License](https://poser.pugx.org/josantonius/json/license)](LICENSE)
[![Total Downloads](https://poser.pugx.org/josantonius/json/downloads)](https://packagist.org/packages/josantonius/json)
[![CI](https://github.com/josantonius/php-json/actions/workflows/ci.yml/badge.svg?branch=main)](https://github.com/josantonius/php-json/actions/workflows/ci.yml)
[![CodeCov](https://codecov.io/gh/josantonius/php-json/branch/main/graph/badge.svg)](https://codecov.io/gh/josantonius/php-json)
[![PSR1](https://img.shields.io/badge/PSR-1-f57046.svg)](https://www.php-fig.org/psr/psr-1/)
[![PSR4](https://img.shields.io/badge/PSR-4-9b59b6.svg)](https://www.php-fig.org/psr/psr-4/)
[![PSR12](https://img.shields.io/badge/PSR-12-1abc9c.svg)](https://www.php-fig.org/psr/psr-12/)

**Translations**: [Español](.github/lang/es-ES/README.md)

PHP simple library for managing JSON files.

---

- [Requirements](#requirements)
- [Installation](#installation)
- [Available Classes](#available-classes)
  - [Json Class](#json-class)
- [Exceptions Used](#exceptions-used)
- [Usage](#usage)
- [Tests](#tests)
- [TODO](#todo)
- [Changelog](#changelog)
- [Contribution](#contribution)
- [Sponsor](#sponsor)
- [License](#license)

---

## Requirements

- Operating System: Linux.

- PHP versions: 8.0 | 8.1 | 8.2.

## Installation

The preferred way to install this extension is through [Composer](http://getcomposer.org/download/).

To install **PHP JSON library**, simply:

```console
composer require josantonius/json
```

The previous command will only install the necessary files,
if you prefer to **download the entire source code** you can use:

```console
composer require josantonius/json --prefer-source
```

You can also **clone the complete repository** with Git:

```console
git clone https://github.com/josantonius/php-json.git
```

## Available Classes

### Json Class

`Josantonius\Json\Json`

Check whether a local or remote file exists.

```php
public function exists(): bool;
```

Get JSON file contents:

```php
/**
 * @throws GetFileException   if there is an error when getting a file.
 * @throws JsonErrorException if there is an error when parsing a JSON file.
 */
public function get(): array;
```

Get the path or URL of the JSON file.

```php
public function filepath(): string;
```

Set the content of the JSON file:

```php
/**
 * @throws CreateFileException        if there is an error when creating a file.
 * @throws CreateDirectoryException   if the directory cannot be created.
 * @throws UnavailableMethodException if the method is not available.
 */
public function set(array|object $content = []): void;
```

Merge into JSON file:

```php
/**
 * @throws GetFileException           if there is an error when getting a file.
 * @throws JsonErrorException         if there is an error when parsing a JSON file.
 * @throws UnavailableMethodException if the method is not available.
 */
public function merge(array|object $content): array;
```

Push on the JSON file:

```php
/**
 * @throws GetFileException           if there is an error when getting a file.
 * @throws JsonErrorException         if there is an error when parsing a JSON file.
 * @throws UnavailableMethodException if the method is not available.
 */
public function push(array|object $content): array;
```

## Exceptions Used

```php
use Josantonius\Json\Exceptions\GetFileException;
use Josantonius\Json\Exceptions\CreateFileException;
use Josantonius\Json\Exceptions\JsonErrorException;
use Josantonius\Json\Exceptions\CreateDirectoryException;
use Josantonius\Json\Exceptions\UnavailableMethodException;
```

## Usage

Example of use for this library:

### Check whether a local file exists

**`index.php`**

```php
use Josantonius\Json\Json;

$json = new Json('file.json');

$json->exists(); // bool
```

### Check whether a remote file exists

**`index.php`**

```php
use Josantonius\Json\Json;

$json = new Json('https://example.com/file.json');

$json->exists(); // bool
```

### Get the JSON file contents

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

### Get the JSON file contents from URL

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

### Get the path of the JSON file

**`index.php`**

```php
use Josantonius\Json\Json;

$json = new Json('file.json');

$json->filepath(); // 'file.json'
```

### Get the URL of the remote JSON file

**`index.php`**

```php
use Josantonius\Json\Json;

$json = new Json('https://example.com/file.json');

$json->filepath(); // 'https://example.com/file.json'
```

### Set an empty array in the JSON file contents

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

### Set the JSON file contents

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

### Merge data into JSON file

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

### Push data on the JSON file

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

To run [tests](tests) you just need [composer](http://getcomposer.org/download/)
and to execute the following:

```console
git clone https://github.com/josantonius/php-json.git
```

```console
cd php-json
```

```console
composer install
```

Run unit tests with [PHPUnit](https://phpunit.de/):

```console
composer phpunit
```

Run code standard tests with [PHPCS](https://github.com/squizlabs/PHP_CodeSniffer):

```console
composer phpcs
```

Run [PHP Mess Detector](https://phpmd.org/) tests to detect inconsistencies in code style:

```console
composer phpmd
```

Run all previous tests:

```console
composer tests
```

## TODO

- [ ] Add new feature
- [ ] Improve tests
- [ ] Improve documentation
- [ ] Improve English translation in the README file
- [ ] Refactor code for disabled code style rules (see phpmd.xml and phpcs.xml)

## Changelog

Detailed changes for each release are documented in the
[release notes](https://github.com/josantonius/php-json/releases).

## Contribution

Please make sure to read the [Contributing Guide](.github/CONTRIBUTING.md), before making a pull
request, start a discussion or report a issue.

Thanks to all [contributors](https://github.com/josantonius/php-json/graphs/contributors)! :heart:

## Sponsor

If this project helps you to reduce your development time,
[you can sponsor me](https://github.com/josantonius#sponsor) to support my open source work :blush:

## License

This repository is licensed under the [MIT License](LICENSE).

Copyright © 2016-present, [Josantonius](https://github.com/josantonius#contact)
