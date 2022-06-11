<?php

/**
 * PHP simple library for managing JSON files.
 *
 * @author    Josantonius <hello@josantonius.dev>
 * @copyright 2016 (c) Josantonius
 * @license   https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @link      https://github.com/josantonius/php-json
 * @since     1.1.3
 */
namespace Josantonius\Json;

use Josantonius\Json\Exception\JsonException;
use PHPUnit\Framework\TestCase;

/**
 * Tests class for JSON library.
 */
class JsonTest extends TestCase
{
    /**
     * JSON instance.
     *
     * @since 1.1.6
     *
     * @var object
     */
    protected $json;

    /**
     * Set up.
     *
     * @since 1.1.6
     */
    public function setUp()
    {
        parent::setUp();

        $this->json = new Json;
    }

    /**
     * Check if it is an instance of JSON.
     *
     * @since 1.1.6
     */
    public function testGetCollection()
    {
        $this->assertInstanceOf('Josantonius\Json\Json', $this->json);
    }

    /**
     * Creating JSON file from array.
     */
    public function testArrayToFile()
    {
        $json = $this->json;

        $array = [
            'name'  => 'Josantonius',
            'email' => 'hello@josantonius.dev',
            'url'   => 'https://github.com/josantonius/php-json',
        ];

        $file   = __DIR__.'/filename.json';
        $result = $json::arrayToFile($array, $file);

        $this->assertFileIsReadable($file);

        $this->assertTrue($result);
    }

    /**
     * Exception to creating JSON file from array.
     */
    public function testArrayToFileCreateFileException()
    {
        $json = $this->json;

        $this->expectException(JsonException::class);

        $json::arrayToFile([], '..');
    }

    /**
     * Get to array the JSON file content.
     */
    public function testFileToArray()
    {
        $json = $this->json;

        $file = __DIR__.'/filename.json';

        $this->assertArrayHasKey('name', $json::fileToArray($file));
        $this->assertArrayHasKey('email', $json::fileToArray($file));
        $this->assertArrayHasKey('url', $json::fileToArray($file));

        unlink($file);
    }

    /**
     * Error when file doesn't exist and cannot create file.
     */
    public function testFileToArrayCreateFileException()
    {
        $json = $this->json;

        $this->expectException(JsonException::class);

        $json::fileToArray(__DIR__.'');
    }

    /**
     * Get external JSON file and save as array.
     */
    public function testExternalFileToArray()
    {
        $json = $this->json;

        $file = 'https://raw.githubusercontent.com/josantonius/php-json/master/composer.json';

        $this->assertArrayHasKey('name', $json::fileToArray($file));
        $this->assertArrayHasKey('type', $json::fileToArray($file));
    }

    /**
     * Get external JSON file and save as array.
     */
    public function testExternalFileNonExistentToArray()
    {
        $json = $this->json;

        $file = 'https://raw.githubusercontent.com/composer.json';

        $this->assertFalse($json::fileToArray($file));
    }
}
