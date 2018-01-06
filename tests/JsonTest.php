<?php
/**
 * PHP simple library for managing Json files.
 *
 * @author    Josantonius <hello@josantonius.com>
 * @copyright 2016 - 2018 (c) Josantonius - PHP-Json
 * @license   https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @link      https://github.com/Josantonius/PHP-Json
 * @since     1.1.3
 */
namespace Josantonius\Json;

use Josantonius\Json\Exception\JsonException;
use PHPUnit\Framework\TestCase;

/**
 * Tests class for Json library.
 */
class JsonTest extends TestCase
{
    /**
     * Json instance.
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
     * Check if it is an instance of Json.
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
            'name' => 'Josantonius',
            'email' => 'info@josantonius.com',
            'url' => 'https://github.com/josantonius/PHP-Json',
        ];

        $file = __DIR__ . '/filename.jsond';
        $result =  $json::arrayToFile($array, $file);

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
        
        $file = __DIR__ . '/filename.jsond';

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

         $json::fileToArray(__DIR__ . '');
    }

    /**
     * Get external JSON file and save as array.
     */
    public function testExternalFileToArray()
    {
        $json = $this->json;
        
        $file = 'https://raw.githubusercontent.com/Josantonius/PHP-Json/master/composer.json';

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
