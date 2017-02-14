# PHP Json library

[![Latest Stable Version](https://poser.pugx.org/josantonius/json/v/stable)](https://packagist.org/packages/josantonius/json) [![Total Downloads](https://poser.pugx.org/josantonius/json/downloads)](https://packagist.org/packages/josantonius/json) [![Latest Unstable Version](https://poser.pugx.org/josantonius/json/v/unstable)](https://packagist.org/packages/josantonius/json) [![License](https://poser.pugx.org/josantonius/json/license)](https://packagist.org/packages/josantonius/json)

[Spanish version](README-ES.md)

PHP simple library for managing Json files.

---

- [Installation](#installation)
- [Requirements](#requirements)
- [Quick Start and Examples](#quick-start-and-examples)
- [Available Methods](#available-methods)
- [Usage](#usage)
- [Tests](#tests)
- [Exception Handler](#exception-handler)
- [Contribute](#contribute)
- [Repository](#repository)
- [Author](#author)
- [Licensing](#licensing)

---

### Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

To install PHP Json library, simply:

    $ composer require Josantonius/Json

### Requirements

This library is supported by PHP versions 5.6 or higher and is compatible with HHVM versions 3.0 or higher.

### Quick Start and Examples

To use this class, simply:

```php
require __DIR__ . '/vendor/autoload.php';

use Josantonius\Json\Json;
```
### Available Methods

Available methods in this library:

```php
Json::arrayToFile();
Json::fileToArray();
Json::jsonLastError();
```
### Usage

Example of use for this library:

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

/* This will create "filename.json" in the "tests" folder. */
```

### Tests 

To use the [test](tests) class, simply:

```php
<?php
$loader = require __DIR__ . '/vendor/autoload.php';

$loader->addPsr4('Josantonius\\Json\\Tests\\', __DIR__ . '/vendor/josantonius/json/tests');

use Josantonius\Json\Tests\JsonTest;

```
Available test methods in this library:

```php
JsonTest::testArrayToFile();
JsonTest::testArrayToFileError();
JsonTest::testFileToArray();
JsonTest::testFileToArrayError();
```

### Exception Handler

This library uses [exception handler](src/Exception) that you can customize.
### Contribute
1. Check for open issues or open a new issue to start a discussion around a bug or feature.
1. Fork the repository on GitHub to start making your changes.
1. Write one or more tests for the new feature or that expose the bug.
1. Make code changes to implement the feature or fix the bug.
1. Send a pull request to get your changes merged and published.

This is intended for large and long-lived objects.

### Repository

All files in this repository were created and uploaded automatically with [Reposgit Creator](https://github.com/Josantonius/BASH-Reposgit).

### Author

Maintained by [Josantonius](https://github.com/Josantonius/).

### Licensing

This project is licensed under **MIT license**. See the [LICENSE](LICENSE) file for more info.