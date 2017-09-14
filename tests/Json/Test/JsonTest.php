<?php 
/**
 * PHP simple library for managing Json files.
 * 
 * @author     Josantonius - hello@josantonius.com
 * @copyright  Copyright (c) 2016 - 2017
 * @license    https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @link       https://github.com/Josantonius/PHP-Json
 * @since      1.1.3
 */

namespace Josantonius\Json\Test;

use Josantonius\Json\Json,
    PHPUnit\Framework\TestCase,
    Josantonius\Json\Exception\JsonException;

/**
 * Tests class for Json library.
 *
 * @since 1.1.3
 */
class JsonTest extends TestCase { 

    /**
     * Creating JSON file from array.
     *
     * @since 1.1.3
     *
     * @return void
     */
    public function testArrayToFile() {

        $array = [

            'name'  => 'Josantonius',
            'email' => 'info@josantonius.com',
            'url'   => 'https://github.com/josantonius/PHP-Json'
        ];

        $file = __DIR__ . '/filename.jsond';
        
        $result = Json::arrayToFile($array, $file);

        $this->assertFileIsReadable($file);

        $this->assertTrue($result);
    }

    /**
     * Exception to creating JSON file from array.
     *
     * @since 1.1.3
     *
     * @return void
     */
    public function testArrayToFileCreateFileException() {
        
        $this->expectException(JsonException::class);

        Json::arrayToFile([], '..');
    }

    /**
     * Get to array the JSON file content.
     *
     * @since 1.1.3
     *
     * @return void
     */
    public function testFileToArray() {

        $file = __DIR__ . '/filename.jsond';

        $this->assertArrayHasKey('name',  Json::fileToArray($file));
        $this->assertArrayHasKey('email', Json::fileToArray($file));
        $this->assertArrayHasKey('url',   Json::fileToArray($file));

        unlink($file);
    }

    /**
     * Error when file doesn't exist and cannot create file.
     *
     * @since 1.1.3
     *
     * @return void
     */
    public function testFileToArrayCreateFileException() {

        $this->expectException(JsonException::class);

        Json::fileToArray(__DIR__ . '');
    }

    /**
     * Get external JSON file and save as array.
     *
     * @since 1.1.3
     *
     * @return void
     */
    public function testExternalFileToArray() {

        $file = 'https://raw.githubusercontent.com/Josantonius/PHP-Json/master/composer.json';

        $this->assertArrayHasKey('name',    Json::fileToArray($file));
        $this->assertArrayHasKey('version', Json::fileToArray($file));
        $this->assertArrayHasKey('type',    Json::fileToArray($file));
    }

    /**
     * Get external JSON file and save as array.
     *
     * @since 1.1.3
     *
     * @return void
     */
    public function testExternalFileNonExistentToArray() {

        $file = 'https://raw.githubusercontent.com/composer.json';

        $this->assertFalse(Json::fileToArray($file));
    }
}
