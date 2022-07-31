# CHANGELOG

## [v2.0.4](https://github.com/josantonius/php-json/releases/tag/v2.0.4) (2022-07-13)

* Fix exceptions comment.

* The namespaces in the test classes were sorted.

* Changed the PHPUnit version from `9.0` to `9.5`.

* Fixed blank line at the beginning of the file in `FUNDING.yml`.

## [v2.0.3](https://github.com/josantonius/php-json/releases/tag/v2.0.3) (2022-07-13)

* Fixed tags in `composer.json`.

## [v2.0.2](https://github.com/josantonius/php-json/releases/tag/v2.0.2) (2022-07-13)

* Improved documentation.

## [v2.0.1](https://github.com/josantonius/php-json/releases/tag/v2.0.1) (2022-06-28)

* Exceptions were refactored.

* Changes in documentation.

* New code style rules have been added.

* Implemented `PSR12 coding standard` from all library PHP files.

* DELETED:
  
  `Josantonius\Json\Json::arrayToFile` method.
  
  `Josantonius\Json\Json::fileToArray` method.
  
  `Josantonius\Json\Tests\JsonTest` class.

* ADDED:
  
  `Josantonius\Json\Tests\ConstructMethodTest` class.

  `Josantonius\Json\Tests\GetMethodTest` class.

  `Josantonius\Json\Tests\MergeMethodTest` class.

  `Josantonius\Json\Tests\PushMethodTest` class.

  `Josantonius\Json\Tests\SetMethodTest` class.

## [2.0.0](https://github.com/josantonius/php-json/releases/tag/2.0.0) (2022-06-16)

* The library was completely refactored.

* Static methods are no longer used.

* New methods were added to merge and push content in JSON files.

* The JSON error handling class was removed in preference to a single method.

* To continue using the version with static methods without the new features:

  * For older versions of PHP (from **5.6** to **7.4**),
[version 1.1.9](https://github.com/josantonius/php-json/tree/1.1.9) of this library can be used.

  * For PHP versions **8.0** and **8.1**,
[version 1.2.0](https://github.com/josantonius/php-json/tree/1.2.0) of this library can be used.

* Deprecated `Josantonius\Json\Json::arrayToFile` method.
* Deprecated `Josantonius\Json\Json::fileToArray` method.

* Deleted `Josantonius\Json\Exception\JsonException` class.
* Deleted `Josantonius\Json\JsonLastError` class.
* Deleted `Josantonius\Json\Tests\JsonLastErrorTest` class.

* Added `Josantonius\Json\Exception\CreateDirectoryException` class.
* Added `Josantonius\Json\Exception\CreateFileException` class.
* Added `Josantonius\Json\Exception\GetFileException` class.
* Added `Josantonius\Json\Exception\JsonErrorException` class.
* Added `Josantonius\Json\Exception\UnavailableMethodException` class.

* Deleted `Josantonius\Json\Json::createDirectory` method.
* Deleted `Josantonius\Json\Json::saveFile` method.

* Added `Josantonius\Json\Json->__construct()` method.
* Added `Josantonius\Json\Json->get()` method.
* Added `Josantonius\Json\Json->set()` method.
* Added `Josantonius\Json\Json->merge()` method.
* Added `Josantonius\Json\Json->push()` method.
* Added `Josantonius\Json\Json->createFileIfNotExists()` private method.
* Added `Josantonius\Json\Json->createDirIfNotExists()` private method.
* Added `Josantonius\Json\Json->getFileContents()` private method.
* Added `Josantonius\Json\Json->saveToJsonFile()` private method.
* Added `Josantonius\Json\Json->checkJsonLastError()` private method.

* Deleted `JsonTest->testGetCollection()` method.
* Deleted `JsonTest->testArrayToFileCreateFileException()` method.
* Deleted `JsonTest->testFileToArray()` method.
* Deleted `JsonTest->testFileToArrayCreateFileException()` method.
* Deleted `JsonTest->testExternalFileToArray()` method.
* Deleted `JsonTest->testExternalFileNonExistentToArray()` method.

* Added `JsonTest->itShouldReturnValidInstance()` method.
* Added `JsonTest->constructorShouldCreateTheFileIfNotExist()` method.
* Added `JsonTest->constructorShouldThrowExceptionIfPathIsWrong()` method.
* Added `JsonTest->constructorShouldThrowExceptionIfFilenameIsWrong()` method.
* Added `JsonTest->itShouldGetFileContents()` method.
* Added `JsonTest->itShouldGetRemoteFileContents()` method.
* Added `JsonTest->itShouldSetArrayOnJsonFile()` method.
* Added `JsonTest->itShouldSetObjectOnJsonFile()` method.
* Added `JsonTest->itShouldThrowExceptionIfSetMethodIsUsedWithRemoteFile()` method.
* Added `JsonTest->itShouldMergeArrayOnJsonFile()` method.
* Added `JsonTest->itShouldMergeObjectOnJsonFile()` method.
* Added `JsonTest->itShouldThrowExceptionIfMergeMethodIsUsedWithRemoteFile()` method.
* Added `JsonTest->itShouldPushArrayOnJsonFile()` method.
* Added `JsonTest->itShouldPushObjectOnJsonFile()` method.
* Added `JsonTest->itShouldThrowExceptionIfPushMethodIsUsedWithRemoteFile()` method.
* Added `JsonTest->itShouldThrowExceptionIfFileCannotBeObtained()` method.
* Added `JsonTest->itShouldThrowExceptionIfRemoteFileCannotBeObtained()` method.
* Added `JsonTest->itShouldThrowExceptionWhenThereAreJsonErrorsInTheFile()` method.
* Added `JsonTest->arrayToFileStaticMethodShouldBehaveLikeTheSetMethod()` method.
* Added `JsonTest->fileToArrayStaticMethodShouldBehaveLikeTheGetMethod()` method.

## [1.2.0](https://github.com/josantonius/php-json/releases/tag/1.2.0) (2022-06-13)

* Support for PHP version **8.0** and higher.

* Support for earlier versions of PHP **8.0** is discontinued.

* For older versions of PHP (from **5.6** to **7.4**)
[version 1.1.9](https://github.com/josantonius/php-json/tree/1.1.9) of this library can be used.

## [1.1.9](https://github.com/josantonius/php-json/releases/tag/1.1.9) (2022-06-11)

* Fix sending code coverage report to Codecov.io.

## [1.1.8](https://github.com/josantonius/php-json/releases/tag/1.1.8) (2022-06-11)

* Added support for `PHP 7.3` and `7.4`.

* Improved documentation; `README.md`, `CODE_OF_CONDUCT.md`, `CONTRIBUTING.md` and `CHANGELOG.md`.

* Removed `Codacy`.

* Removed `PHP Coding Standards Fixer`.

* The `master` branch was renamed to `main`.

* The `develop` branch was added to use a workflow based on `Git Flow`.

* `Travis` is discontinued for continuous integration. `GitHub Actions` will be used from now on.

* Added `.github/CODE_OF_CONDUCT.md` file.
* Added `.github/CONTRIBUTING.md` file.
* Added `.github/FUNDING.yml` file.
* Added `.github/workflows/ci.yml` file.
* Added `.github/lang/es-ES/CODE_OF_CONDUCT.md` file.
* Added `.github/lang/es-ES/CONTRIBUTING.md` file.
* Added `.github/lang/es-ES/LICENSE` file.
* Added `.github/lang/es-ES/README` file.

* Deleted `.travis.yml` file.
* Deleted `.editorconfig` file.
* Deleted `CONDUCT.MD` file.
* Deleted `README-ES.MD` file.
* Deleted `.php_cs.dist` file.

## [1.1.7](https://github.com/josantonius/php-json/releases/tag/1.1.7) (2018-01-04)

* The tests were fixed.

* Changes in documentation.

* JSON last error handling was implemented in a new class and replace collections with switch case: `JsonLastError`.

* Tests were implemented for `JsonLastError` class.

## [1.1.6](https://github.com/josantonius/php-json/releases/tag/1.1.6) (2017-11-08)

* Implemented `PHP Mess Detector` to detect inconsistencies in code styles.

* Implemented `PHP Code Beautifier and Fixer` to fixing errors automatically.

* Implemented `PHP Coding Standards Fixer` to organize PHP code automatically according to PSR standards.

## [1.1.5](https://github.com/josantonius/php-json/releases/tag/1.1.5) (2017-11-01)

* Implemented `PSR-4 autoloader standard` from all library files.

* Implemented `PSR-2 coding standard` from all library PHP files.

* Implemented `PHPCS` to ensure that PHP code complies with `PSR2` code standards.

* Implemented `Codacy` to automates code reviews and monitors code quality over time.

* Implemented `Codecov` to coverage reports.

* Added `phpcs.ruleset.xml` file.

* Deleted `src/bootstrap.php` file.

* Deleted `tests/bootstrap.php` file.

* Deleted `vendor` folder.

* Changed `Josantonius\Json\Test\JsonTest` class to  `Josantonius\Json\JsonTest` class.

## [1.1.4](https://github.com/josantonius/php-json/releases/tag/1.1.4) (2017-09-10)

* Unit tests supported by `PHPUnit` were added.

* The repository was synchronized with Travis CI to implement continuous integration.

* Added `src/bootstrap.php` file

* Added `tests/bootstrap.php` file.

* Added `phpunit.xml.dist` file.
* Added `_config.yml` file.
* Added `.travis.yml` file.

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

## [1.1.3](https://github.com/josantonius/php-json/releases/tag/1.1.3) (2017-08-20)

* Added `Josantonius\Json\Json::_jsonLastError()` method.
* Added `Josantonius\Json\Json::_createDirectory()` method.
* Added `Josantonius\Json\Json::_saveFile()` method.

* Removed `Josantonius\Json\Json::jsonLastError()` method.

* Now in the `fileToArray()` method files can be obtained from external urls.

* Now checking json last error returns an array with the error instead of an exception.

* New errors available from PHP 7.0 to check for errors from `json_last_error()` were added.

## [1.1.2](https://github.com/josantonius/php-json/releases/tag/1.1.2) (2017-05-31)

* The file exception not found in the `fileToArray()` method was deleted.
Now if it does not exist the file will create it with an empty array.

* `JSON_PRETTY_PRINT` was added at time to create the json file.

## [1.1.1](https://github.com/josantonius/php-json/releases/tag/1.1.1) (2017-03-18)

* Some files were excluded from download and comments and readme files were updated.

## [1.1.0](https://github.com/josantonius/php-json/releases/tag/1.1.0) (2017-01-30)

* Compatible with PHP 5.6 or higher.

## [1.0.0](https://github.com/josantonius/php-json/releases/tag/1.0.0) (2016-12-14)

* Compatible only with PHP 7.0 or higher.
In the next versions, the library will be modified to make it compatible with PHP 5.6 or higher.

* Added `Josantonius\Json\Json` class.
* Added `Josantonius\Json\Json::arrayToFile()` method.
* Added `Josantonius\Json\Json::fileToArray()` method.
* Added `Josantonius\Json\Json::jsonLastError()` method.

* Added `Josantonius\Json\Exception\JsonException` class.
* Added `Josantonius\Json\Exception\Exceptions` abstract class.
* Added `Josantonius\Json\Exception\JsonException->__construct()` method.

* Added `Josantonius\Json\Tests\JsonTest` class.
* Added `Josantonius\Json\Tests\JsonTest::testArrayToFile()` method.
* Added `Josantonius\Json\Tests\JsonTest::testArrayToFileError()` method.
* Added `Josantonius\Json\Tests\JsonTest::testFileToArray()` method.
* Added `Josantonius\Json\Tests\JsonTest::testFileToArrayError()` method.
