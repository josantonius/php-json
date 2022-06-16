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
- [TODO](#-todo)
- [Changelog](#changelog)
- [Contribution](#contribution)
- [Sponsor](#Sponsor)
- [License](#license)

---

## Requirements

This library is compatible from **PHP 8.0** version to **PHP 8.1** version.

To continue using the version with static methods without the new features:

- For older versions of PHP (from **5.6** to **7.4**),
[version 1.1.9](https://github.com/josantonius/php-json/tree/1.1.9) of this library can be used.

- For PHP versions **8.0** and **8.1**,
[version 1.2.0](https://github.com/josantonius/php-json/tree/1.2.0) of this library can be used.

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

## Available Methods

Available methods in this library:

### Get JSON file contents

```php
$json->get();
```

**@throws** _CreateDirectoryException_ | _CreateFileException_ | _JsonErrorException_

**@Return** `array` - _File contents_

### Set the content of the JSON file

```php
$json->set(array|object $content);
```

**@throws** _CreateFileException_ | _JsonErrorException_ | _UnavailableMethodException_

**@Return** `void`

### Merge into JSON file

```php
$json->merge(array|object $content);
```

**@throws** _CreateFileException_ | _GetFileException_ | _JsonErrorException_ | _UnavailableMethodException_

**@Return** `array` - _Resulting array_

### Push on the JSON file

```php
$json->push(array|object $content);
```

**@throws** _CreateFileException_ | _GetFileException_ | _JsonErrorException_ | _UnavailableMethodException_

**@Return** `array` - _Resulting array_

## Quick Start

To use this library with **Composer**:

```php
require __DIR__ . '/vendor/autoload.php';

use josantonius\Json\Json;
```

```php
$json = new Json('path/to/file.json');

# If the file does not exist it will be created.
```

OR

```php
$json = new Json('https://site.com/file.json');

# When the JSON file is obtained from a URL, only the "get" method is available.
```

## Usage

Example of use for this library:

### Get the JSON file contents

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

### Set the JSON file contents

```php
$json->set(['foo' => 'bar']);
```

```json
{
    "foo": "bar"
}
```

### Merge data into JSON file

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

### Push data on the JSON file

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

If this project helps you to reduce your development time and you want to thank me,
[you could sponsor me!](https://github.com/josantonius#sponsor) :blush:

## License

This repository is licensed under the [MIT License](LICENSE).

Copyright © 2016-present, [Josantonius](https://github.com/josantonius#contact)
