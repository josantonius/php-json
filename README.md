# PHP JSON library

[![Latest Stable Version](https://poser.pugx.org/josantonius/Json/v/stable)](https://packagist.org/packages/josantonius/json)
[![License](https://poser.pugx.org/josantonius/json/license)](LICENSE)
[![Total Downloads](https://poser.pugx.org/josantonius/json/downloads)](https://packagist.org/packages/josantonius/json)
[![CI](https://github.com/josantonius/php-json/actions/workflows/ci.yml/badge.svg?branch=main)](https://github.com/josantonius/php-json/actions/workflows/ci.yml)
[![PSR2](https://img.shields.io/badge/PSR-2-1abc9c.svg)](http://www.php-fig.org/psr/psr-2/)
[![PSR4](https://img.shields.io/badge/PSR-4-9b59b6.svg)](http://www.php-fig.org/psr/psr-4/)
[![CodeCov](https://codecov.io/gh/josantonius/php-json/branch/main/graph/badge.svg)](https://codecov.io/gh/josantonius/php-json)

**Translations**: [Español](.github/lang/es-ES/README.md)

PHP simple library for managing JSON files.

---

- [Requirements](#requirements)
- [Installation](#installation)
- [Available Methods](#available-methods)
- [Quick Start](#quick-start)
- [Usage](#usage)
- [Tests](#tests)
- [Exception Handler](#exception-handler)
- [TODO](#-todo)
- [Changelog](#changelog)
- [Contribution](#contribution)
- [Sponsor](#Sponsor)
- [License](#license)

---

## Requirements

This library is compatible from **PHP 8.0** version to **PHP 8.1** version.

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

Or **install it manually**:

Download [Json.php](https://raw.githubusercontent.com/josantonius/php-json/main/src/Json.php),
[JsonLastError.php](https://raw.githubusercontent.com/josantonius/php-json/main/src/JsonLastError.php) and
[JsonException.php](https://raw.githubusercontent.com/josantonius/php-json/main/src/Exception/JsonException.php):

```console
wget https://raw.githubusercontent.com/josantonius/php-json/main/src/Json.php
```

```console
wget https://raw.githubusercontent.com/josantonius/php-json/main/src/JsonLastError.php
```

```console
wget https://raw.githubusercontent.com/josantonius/php-json/main/src/Exception/JsonException.php
```

## Available Methods

Available methods in this library:

### Create JSON file from array

```php
Json::arrayToFile($array, $file);
```

| Attribute | Description | Type | Required | Default
| --- | --- | --- | --- | --- |
| $array | Array to be converted to JSON. | array | Yes | |
| $file | Path to the file. | string | Yes | |

**# Return** (boolean)

### Save to array the JSON file content

```php
Json::fileToArray($file);
```

| Attribute | Description | Type | Required | Default
| --- | --- | --- | --- | --- |
| $file | Path or external url to JSON file. | string | Yes | |

**# Return** (array|false)

### Check for errors

```php
JsonLastError::check();
```

**# Return** (array|null) → Null if there are no errors or array with state  code and error message.

### Get collection of JSON errors

```php
JsonLastError::getCollection();
```

**# Return** (array) → Collection of JSON errors.

## Quick Start

To use this library with **Composer**:

```php
require __DIR__ . '/vendor/autoload.php';

use josantonius\Json\Json;
```

Or If you installed it **manually**, use it:

```php
require_once __DIR__ . '/Json.php';
require_once __DIR__ . '/JsonLastError.php';
require_once __DIR__ . '/JsonException.php';

use josantonius\Json\Json;
```

## Usage

Example of use for this library:

### Create a JSON file from an array

```php
$array = [
 'name'  => 'josantonius',
    'email' => 'info@josantonius.dev',
    'url'   => 'https://github.com/josantonius/php-json'
];

$filepath = __DIR__ . '/filename.json';

Json::arrayToFile($array, $filepath);
```

### Save the contents of the JSON file in an array

```php
$filepath = __DIR__ . '/filename.json';

$array = Json::fileToArray($filepath);
```

### Checks for errors

```php
$lastError = JsonLastError::check();

if (!is_null($lastError)) {
    var_dump($lastError);
}
```

### Get a JSON error collection

```php
$jsonLastErrorCollection = JsonLastError::getCollection();
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

Run [PSR2](http://www.php-fig.org/psr/psr-2/) code standard tests with
[PHPCS](https://github.com/squizlabs/PHP_CodeSniffer):

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

## Exception Handler

This library uses [exception handler](src/Exception) that you can customize.

## ☑ TODO

- [ ] Add new feature.
- [ ] Improve tests.
- [ ] Improve documentation.
- [ ] Improve English translation in the README file.
- [ ] Refactor code for disabled code style rules. See [phpmd.xml](phpmd.xml) and [phpcs.xml](phpcs.xml).

## Changelog

Detailed changes for each release are documented in the
[release notes](https://github.com/josantonius/php-json/releases).

## Contribution

Please make sure to read the [Contributing Guide](.github/CONTRIBUTING.md), before making a pull
request, start a discussion or report a issue.

Thanks to all [contributors](https://github.com/josantonius/php-json/graphs/contributors)! :heart:

## Sponsor

If this project help you reduce time to develop,
[you can become my sponsor!](https://github.com/josantonius#sponsor) :blush:

## License

This repository is licensed under the [MIT License](LICENSE).

Copyright © 2016-present, [Josantonius](https://github.com/josantonius#contact)
