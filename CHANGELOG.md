# CHANGELOG

## 1.1.7 - 2018-01-04

* The tests were fixed.

* Changes in documentation.

* JSON last error handling was implemented in a new class and replace collections with switch case: `JsonLastError`.

* Tests were implemented for `JsonLastError` class.

## 1.1.6 - 2017-11-08

* Implemented `PHP Mess Detector` to detect inconsistencies in code styles.

* Implemented `PHP Code Beautifier and Fixer` to fixing errors automatically.

* Implemented `PHP Coding Standards Fixer` to organize PHP code automatically according to PSR standards.

## 1.1.5 - 2017-11-01

* Implemented `PSR-4 autoloader standard` from all library files.

* Implemented `PSR-2 coding standard` from all library PHP files.

* Implemented `PHPCS` to ensure that PHP code complies with `PSR2` code standards.

* Implemented `Codacy` to automates code reviews and monitors code quality over time.

* Implemented `Codecov` to coverage reports.

* Added `Json/phpcs.ruleset.xml` file.

* Deleted `Json/src/bootstrap.php` file.

* Deleted `Json/tests/bootstrap.php` file.

* Deleted `Json/vendor` folder.

* Changed `Josantonius\Json\Test\JsonTest` class to  `Josantonius\Json\JsonTest` class.


## 1.1.4 - 2017-09-10

* Unit tests supported by `PHPUnit` were added.

* The repository was synchronized with Travis CI to implement continuous integration.
 
* Added `Json/src/bootstrap.php` file

* Added `Json/tests/bootstrap.php` file.

* Added `Json/phpunit.xml.dist` file.
* Added `Json/_config.yml` file.
* Added `Json/.travis.yml` file.

* Deleted `Josantonius\Json\Tests\JsonTest` class.
* Deleted `Josantonius\Json\Tests\JsonTest::testArrayToFile()` method.
* Deleted `Josantonius\Json\Tests\JsonTest::testArrayToFileError()` method.
* Deleted `Josantonius\Json\Tests\JsonTest::testFileToArray()` method.
* Deleted `Josantonius\Json\Tests\JsonTest::testFileToArrayError()` method.

* Added `Josantonius\Json\Test\JsonTest` class.
* Added `Josantonius\Json\Test\JsonTest::testArrayToFile()` method.
* Added `Josantonius\Json\Test\JsonTest::testArrayToFileCreateFileException()` method.
* Added `Josantonius\Json\Test\JsonTest::testFileToArray()` method.
* Added `Josantonius\Json\Test\JsonTest::testFileToArrayCreateFileException()` method.
* Added `Josantonius\Json\Test\JsonTest::testExternalFileToArray()` method.
* Added `Josantonius\Json\Test\JsonTest::testExternalFileNonExistentToArray()` method.

## 1.1.3 - 2017-08-20

* Added `Josantonius\Json\Json::_jsonLastError()` method.
* Added `Josantonius\Json\Json::_createDirectory()` method.
* Added `Josantonius\Json\Json::_saveFile()` method.

* Removed `Josantonius\Json\Json::jsonLastError()` method.

* Now in the `fileToArray()` method files can be obtained from external urls.

* Now checking json last error returns an array with the error instead of an exception.

* New errors available from PHP 7.0 to check for errors from `json_last_error()` were added.

## 1.1.2 - 2017-05-31

* The file exception not found in the `fileToArray()` method was deleted. Now if it does not exist the file will create it with an empty array.

* `JSON_PRETTY_PRINT` was added at time to create the json file.

## 1.1.1 - 2017-03-18

* Some files were excluded from download and comments and readme files were updated.

## 1.1.0 - 2017-01-30

* Compatible with PHP 5.6 or higher.

## 1.0.0 - 2017-01-30

* Compatible only with PHP 7.0 or higher. In the next versions, the library will be modified to make it compatible with PHP 5.6 or higher.

## 1.0.0 - 2016-12-14

* Added `Josantonius\Json\Json` class.
* Added `Josantonius\Json\Json::arrayToFile()` method.
* Added `Josantonius\Json\Json::fileToArray()` method.
* Added `Josantonius\Json\Json::jsonLastError()` method.

## 1.0.0 - 2016-12-14

* Added `Josantonius\Json\Exception\JsonException` class.
* Added `Josantonius\Json\Exception\Exceptions` abstract class.
* Added `Josantonius\Json\Exception\JsonException->__construct()` method.

## 1.0.0 - 2016-12-14

* Added `Josantonius\Json\Tests\JsonTest` class.
* Added `Josantonius\Json\Tests\JsonTest::testArrayToFile()` method.
* Added `Josantonius\Json\Tests\JsonTest::testArrayToFileError()` method.
* Added `Josantonius\Json\Tests\JsonTest::testFileToArray()` method.
* Added `Josantonius\Json\Tests\JsonTest::testFileToArrayError()` method.
