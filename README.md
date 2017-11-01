# PHP Json library

[![Latest Stable Version](https://poser.pugx.org/josantonius/Json/v/stable)](https://packagist.org/packages/josantonius/Json) [![Latest Unstable Version](https://poser.pugx.org/josantonius/Json/v/unstable)](https://packagist.org/packages/josantonius/Json) [![License](https://poser.pugx.org/josantonius/Json/license)](LICENSE) [![Codacy Badge](https://api.codacy.com/project/badge/Grade/ff3e82fba0d44889bc5ae211cffddb72)](https://www.codacy.com/app/Josantonius/PHP-Json?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=Josantonius/PHP-Json&amp;utm_campaign=Badge_Grade) [![Total Downloads](https://poser.pugx.org/josantonius/Json/downloads)](https://packagist.org/packages/josantonius/Json) [![Travis](https://travis-ci.org/Josantonius/PHP-Json.svg)](https://travis-ci.org/Josantonius/PHP-Json) [![PSR2](https://img.shields.io/badge/PSR-2-1abc9c.svg)](http://www.php-fig.org/psr/psr-2/) [![PSR4](https://img.shields.io/badge/PSR-4-9b59b6.svg)](http://www.php-fig.org/psr/psr-4/) [![CodeCov](https://codecov.io/gh/Josantonius/PHP-Json/branch/master/graph/badge.svg)](https://codecov.io/gh/Josantonius/PHP-Json)

[Versión en español](README-ES.md)

PHP simple library for managing Json files.

---

- [Requirements](#requirements)
- [Installation](#installation)
- [Available Methods](#available-methods)
- [Quick Start](#quick-start)
- [Usage](#usage)
- [Tests](#tests)
- [Exception Handler](#exception-handler)
- [TODO](#-todo)
- [Contribute](#contribute)
- [Repository](#repository)
- [License](#license)
- [Copyright](#copyright)

---

## Requirements

This library is supported by **PHP versions 5.6** or higher and is compatible with **HHVM versions 3.0** or higher.

## Installation

The preferred way to install this extension is through [Composer](http://getcomposer.org/download/).

To install **PHP Json library**, simply:

    $ composer require Josantonius/Json

The previous command will only install the necessary files, if you prefer to **download the entire source code** you can use:

    $ composer require Josantonius/Json --prefer-source

You can also **clone the complete repository** with Git:

  $ git clone https://github.com/Josantonius/PHP-Json.git

Or **install it manually**:

[Download Json.php](https://raw.githubusercontent.com/Josantonius/PHP-Json/master/src/Json.php):

    $ wget https://raw.githubusercontent.com/Josantonius/PHP-Json/master/src/Json.php

## Available Methods

Available methods in this library:

### - Creating JSON file from array:

```php
Json::arrayToFile($array, $file);
```

| Attribute | Description | Type | Required | Default
| --- | --- | --- | --- | --- |
| $array | Array to be converted to JSON. | array | Yes | |
| $file | Path to the file. | string | Yes | |

**# Return** (boolean)

### - Save to array the JSON file content:

```php
Json::fileToArray($file);
```

| Attribute | Description | Type | Required | Default
| --- | --- | --- | --- | --- |
| $file | Path or external url to JSON file. | string | Yes | |

**# Return** (array|false)

## Quick Start

To use this library with **Composer**:

```php
require __DIR__ . '/vendor/autoload.php';

use Josantonius\Json\Json;
```

Or If you installed it **manually**, use it:

```php
require_once __DIR__ . '/Json.php';

use Josantonius\Json\Json;
```

## Usage

Example of use for this library:

### - Creating JSON file from array:

```php

$array = [
	'name'  => 'Josantonius',
    'email' => 'info@josantonius.com',
    'url'   => 'https://github.com/josantonius/PHP-Json'
];

$pathfile = __DIR__ . '/filename.json';

Json::arrayToFile($array, $pathfile);

```

### - Save to array the JSON file content:

```php
$pathfile = __DIR__ . '/filename.json';

$array = Json::fileToArray($pathfile);

```

## Tests 

To run [tests](tests) you just need [Composer](http://getcomposer.org/download/) and to execute the following:

    $ git clone https://github.com/Josantonius/PHP-Json.git
    
    $ cd PHP-Json

    $ composer install

Run unit tests with [PHPUnit](https://phpunit.de/):

    $ composer phpunit

Run [PSR2](http://www.php-fig.org/psr/psr-2/) code standard tests with [PHPCS](https://github.com/squizlabs/PHP_CodeSniffer):

    $ composer phpcs

Run all previous tests:

    $ composer tests

## ☑ TODO

- [x] Create tests
- [x] Improve documentation

## Exception Handler

This library uses [exception handler](src/Exception) that you can customize.

## Contribute

1. Check for open issues or open a new issue to start a discussion around a bug or feature.
1. Fork the repository on GitHub to start making your changes.
1. Write one or more tests for the new feature or that expose the bug.
1. Make code changes to implement the feature or fix the bug.
1. Send a pull request to get your changes merged and published.

This is intended for large and long-lived objects.

## Repository

All files in this repository were created and uploaded automatically with [Reposgit Creator](https://github.com/Josantonius/BASH-Reposgit).

## License

This project is licensed under **MIT license**. See the [LICENSE](LICENSE) file for more info.

## Copyright

2016 -2017 Josantonius, [josantonius.com](https://josantonius.com/)

If you find it useful, let me know :wink:

You can contact me on [Twitter](https://twitter.com/Josantonius) or through my [email](mailto:hello@josantonius.com).
