# PHP JSON library

[![Latest Stable Version](https://poser.pugx.org/josantonius/Json/v/stable)](https://packagist.org/packages/josantonius/json)
[![License](https://poser.pugx.org/josantonius/json/license)](LICENSE)
[![Total Downloads](https://poser.pugx.org/josantonius/json/downloads)](https://packagist.org/packages/josantonius/json)
[![CI](https://github.com/josantonius/php-json/actions/workflows/ci.yml/badge.svg?branch=main)](https://github.com/josantonius/php-json/actions/workflows/ci.yml)
[![CodeCov](https://codecov.io/gh/josantonius/php-json/branch/main/graph/badge.svg)](https://codecov.io/gh/josantonius/php-json)
[![PSR1](https://img.shields.io/badge/PSR-1-f57046.svg)](https://www.php-fig.org/psr/psr-1/)
[![PSR4](https://img.shields.io/badge/PSR-4-9b59b6.svg)](https://www.php-fig.org/psr/psr-4/)
[![PSR12](https://img.shields.io/badge/PSR-12-1abc9c.svg)](https://www.php-fig.org/psr/psr-12/)

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

- PHP versions: 8.1 | 8.2.

## Installation

The preferred way to install this extension is through [Composer](http://getcomposer.org/download/).

To install **PHP JSON library**, simply:

```console
composer require josantonius/json
```

The previous command will only install the necessary files,
if you prefer to **download the full source code** use:

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

Create object referencing the JSON file:

```php
/**
 * @param string $filepath The path to the JSON file to be handled.
 */
public function __construct(public readonly string $filepath)
{
}
```

Get the path to the JSON file:

```php
public readonly string $filepath;
```

Check if the JSON file has already been created:

```php
/**
 * @return bool True if the file exists at the specified filepath, false otherwise.
 */
public function exists(): bool;
```

Get the contents of the JSON file:

```php
/**
 * @param bool $asObject If true and the value is an array, it is returned as an object.
 *
 * @throws GetFileException
 * @throws JsonErrorException
 *
 * @return mixed the contents of the JSON file.
 */
public function get(bool $asObject = false): mixed;
```

Set the contents of a JSON or a key within the file:

```php
/**
 * @param mixed  $content The data that will be written to the file or a key within the file.
 * @param string $dot     The dot notation representing the key to be modified within the file.
 *
 * @throws GetFileException
 * @throws JsonErrorException
 * @throws CreateFileException
 * @throws CreateDirectoryException
 * @throws NoIterableElementException
 *
 * @return mixed the content of the JSON file after the set operation.
 */
public function set(mixed $content = [], string $dot = null): array|bool|int|null|string;
```

Merge the provided data with the contents of a JSON file or a key within the file:

```php
/**
 * @param mixed  $content The data that will be written to the file or a key within the file.
 * @param string $dot     The dot notation representing the key to be modified within the file.
 *
 * @throws GetFileException
 * @throws JsonErrorException
 * @throws NoIterableFileException
 * @throws NoIterableElementException
 *
 * @return mixed the content of the JSON file after the merge operation.
 */
public function merge(array|object $content, string $dot = null): array;
```

Remove and get the last element of a JSON file or a key within the file:

```php
/**
 * @param string $dot The dot notation representing the key to be modified within the file.
 *
 * @throws GetFileException
 * @throws JsonErrorException
 * @throws NoIterableFileException
 * @throws NoIterableElementException
 *
 * @return mixed|null the last value of JSON file, or null if array is empty.
 */
public function pop(string $dot = null): mixed;
```

Add the provided data to the end of the contents of a JSON file or a key within the file:

```php
/**
 * @param mixed  $content The data that will be written to the file or a key within the file.
 * @param string $dot     The dot notation representing the key to be modified within the file.
 *
 * @throws GetFileException
 * @throws JsonErrorException
 * @throws NoIterableFileException
 * @throws NoIterableElementException
 *
 * @return mixed the content of the JSON file after the push operation.
 */
public function push(mixed $content, string $dot = null): array;
```

Remove and get the first element of a JSON file or a key within the file:

```php
/**
 * @param string $dot The dot notation representing the key to be modified within the file.
 *
 * @throws GetFileException
 * @throws JsonErrorException
 * @throws NoIterableFileException
 * @throws NoIterableElementException
 *
 * @return mixed|null the shifted value, or null if array is empty.
 */
public function shift(string $dot = null): mixed(mixed $content, string $dot = null): array;
```

Remove a key and its value from the contents of a JSON file:

```php
/**
 * @param string $dot       The dot notation representing the key to be modified within the file.
 * @param bool   $reindexed If true, the array will be re-indexed.
 *
 * @throws GetFileException
 * @throws JsonErrorException
 * @throws NoIterableFileException
 *
 * @return array the content of the JSON file after the unset operation.
 */
public function unset(string $dot, bool $reindexed = false): array;
```

Add the provided data to the beginning of the contents of a JSON file or a key within the file:

```php
/**
 * @param mixed  $content The data that will be written to the file or a key within the file.
 * @param string $dot     The dot notation representing the key to be modified within the file.
 *
 * @throws GetFileException
 * @throws JsonErrorException
 * @throws NoIterableFileException
 * @throws NoIterableElementException
 *
 * @return mixed the content of the JSON file after the unshift operation.
 */
public function unshift(mixed $content, string $dot = null): mixed;
```

## Exceptions Used

```php
use Josantonius\Json\Exceptions\GetFileException;           // if file reading failed
use Josantonius\Json\Exceptions\CreateFileException;        // if file creation failed
use Josantonius\Json\Exceptions\JsonErrorException;         // if the file contains invalid JSON
use Josantonius\Json\Exceptions\NoIterableFileException;    // if the file isn't a JSON array
use Josantonius\Json\Exceptions\CreateDirectoryException;   // if directory creation failed
use Josantonius\Json\Exceptions\NoIterableElementException; // if $dot isn't an array location
```

## Usage

Example of use for this library:

### Get the path of the JSON file

```php
use Josantonius\Json\Json;

$json = new Json('file.json');

$json->filepath; // 'file.json'
```

### Check whether a local file exists

```php
use Josantonius\Json\Json;

$json = new Json('file.json');

$json->exists(); // bool
```

### Get the JSON file contents as array

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

### Get the JSON file contents as object

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

$json->get(asObject: true); // object(stdClass) { ["foo"] => string(3) "bar" }
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

### Set the contents of a JSON file

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

### Set the contents of a key within the JSON file using dot notation

**`file.json`**

```json
{
    "foo": {
        "bar": []
    }
}
```

**`index.php`**

```php
use Josantonius\Json\Json;

$json = new Json('file.json');

$json->set('baz', 'foo.bar.0');
```

**`file.json`**

```json
{
    "foo": {
        "bar": [
            "baz"
        ]
    }
}
```

### Merge the provided data with the contents of the JSON file

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

### Merge the provided data with the contents of a key within the file using dot notation

**`file.json`**

```json
{
    "foo": [
        {
            "bar": "baz"
        }
    ]
}
```

**`index.php`**

```php
use Josantonius\Json\Json;

$json = new Json('file.json');

$json->merge(['baz' => 'bar'], 'foo.0');
```

**`file.json`**

```json
{
    "foo": [
        {
            "bar": "baz",
            "baz": "bar"
        }
    ]
}
```

### Remove and get the last element of a JSON file

**`file.json`**

```json
[
    1,
    2,
    3
]
```

**`index.php`**

```php
use Josantonius\Json\Json;

$json = new Json('file.json');

$json->pop(); // 3
```

**`file.json`**

```json
[
    1,
    2
]
```

### Remove and get the last element of a key within the file using dot notation

**`file.json`**

```json
{
    "foo": [
        1,
        2,
        3
    ]
}
```

**`index.php`**

```php
use Josantonius\Json\Json;

$json = new Json('file.json');

$json->pop(); // 3
```

**`file.json`**

```json
{
    "foo": [
        1,
        2
    ]
}
```

### Add the provided data to the end of the contents of a JSON file

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

### Add provided data to the end of the contents of a key within the file using dot notation

**`file.json`**

```json
{
    "foo": {
        "bar": [
            []
        ]
    }
}
```

**`index.php`**

```php
use Josantonius\Json\Json;

$json = new Json('file.json');

$json->push('baz', 'foo.bar.0');
```

**`file.json`**

```json
{
    "foo": {
        "bar": [
            [
                "baz"
            ]
        ]
    }
}
```

### Remove and get the first element of the contents of a JSON file

**`file.json`**

```json
[
    1,
    2,
    3
]
```

**`index.php`**

```php
use Josantonius\Json\Json;

$json = new Json('file.json');

$json->shift(); // 1
```

**`file.json`**

```json
[
    2,
    3
]
```

### Remove and get the first item of the contents of a key within the file using dot notation

**`file.json`**

```json
{
    "foo": {
        "bar": [
            [
                1
            ]
        ]
    }
}
```

**`index.php`**

```php
use Josantonius\Json\Json;

$json = new Json('file.json');

$json->shift('foo.bar.0'); // 1
```

**`file.json`**

```json
{
    "foo": {
        "bar": [
            []
        ]
    }
}
```

### Remove a string key and its value from the contents of a JSON file

**`file.json`**

```json
{
    "foo": {
        "bar": [
            []
        ]
    }
}
```

**`index.php`**

```php
use Josantonius\Json\Json;

$json = new Json('file.json');

$json->unset('foo.bar');
```

**`file.json`**

```json
{
    "foo": []
}
```

### Remove a numeric key and its value from the contents of a JSON file

**`file.json`**

```json
[
    1,
    2,
    3
]
```

**`index.php`**

```php
use Josantonius\Json\Json;

$json = new Json('file.json');

$json->unset('1');
```

**`file.json`**

```json
{
    "0": 1,
    "2": 3
}
```

### Remove a numeric key and its value from the contents of a JSON file and re-index it

**`file.json`**

```json
[
    1,
    2,
    3
]
```

**`index.php`**

```php
use Josantonius\Json\Json;

$json = new Json('file.json');

$json->unset('1', reindexed: true);
```

**`file.json`**

```json
[
    1,
    3
]
```

### Add the provided data to the beginning of the contents of a JSON file

**`file.json`**

```json
[
    1,
    2,
    3
]
```

**`index.php`**

```php
use Josantonius\Json\Json;

$json = new Json('file.json');

$json->unshift(0);
```

**`file.json`**

```json
[
    0,
    1,
    2,
    3
]
```

### Add the provided data to the beginning of the contents of a key within the file using dot

**`file.json`**

```json
{
    "foo": {
        "bar": [
            [
                1
            ]
        ]
    }
}
```

**`index.php`**

```php
use Josantonius\Json\Json;

$json = new Json('file.json');

$json->unshift(0, 'foo.bar.0');
```

**`file.json`**

```json
{
    "foo": {
        "bar": [
            [
                0,
                1
            ]
        ]
    }
}
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
