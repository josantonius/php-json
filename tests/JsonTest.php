<?php
/**
 * PHP simple library for managing Json files.
 *
 * @author    Josantonius <hello@josantonius.com>
 * @copyright 2016 - 2017 (c) Josantonius - PHP-Json
 * @license   https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @link      https://github.com/Josantonius/PHP-Json
 * @since     1.1.3
 */
namespace Josantonius\Json;

use Josantonius\Json\Exception\JsonException;
use PHPUnit\Framework\TestCase;

/**
 * Tests class for Json library.
 *
 * @since 1.1.3
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
    protected $Json;

    /**
     * Set up.
     *
     * @since 1.1.6
     */
    public function setUp()
    {
        parent::setUp();

        $this->Json = new Json;
    }

    /**
     * Check if it is an instance of Json.
     *
     * @since 1.1.6
     */
    public function testIsInstanceOfJson()
    {
        $actual = $this->Json;
        $this->assertInstanceOf('Josantonius\Json\Json', $actual);
    }

    /**
     * Creating JSON file from array.
     *
     * @since 1.1.3
     */
    public function testArrayToFile()
    {
        $array = [
            'name' => 'Josantonius',
            'email' => 'info@josantonius.com',
            'url' => 'https://github.com/josantonius/PHP-Json',
        ];

        $file = __DIR__ . '/filename.jsond';
        $result = $this->Json->arrayToFile($array, $file);

        $this->assertFileIsReadable($file);

        $this->assertTrue($result);
    }

    /**
     * Exception to creating JSON file from array.
     *
     * @since 1.1.3
     */
    public function testArrayToFileCreateFileException()
    {
        $this->expectException(JsonException::class);

        $this->Json->arrayToFile([], '..');
    }

    /**
     * Get to array the JSON file content.
     *
     * @since 1.1.3
     */
    public function testFileToArray()
    {
        $file = __DIR__ . '/filename.jsond';

        $this->assertArrayHasKey('name', $this->Json->fileToArray($file));
        $this->assertArrayHasKey('email', $this->Json->fileToArray($file));
        $this->assertArrayHasKey('url', $this->Json->fileToArray($file));

        unlink($file);
    }

    /**
     * Error when file doesn't exist and cannot create file.
     *
     * @since 1.1.3
     */
    public function testFileToArrayCreateFileException()
    {
        $this->expectException(JsonException::class);

        $this->Json->fileToArray(__DIR__ . '');
    }

    /**
     * Get external JSON file and save as array.
     *
     * @since 1.1.3
     */
    public function testExternalFileToArray()
    {
        $file = 'https://raw.githubusercontent.com/Josantonius/PHP-Json/master/composer.json';

        $this->assertArrayHasKey('name', $this->Json->fileToArray($file));
        $this->assertArrayHasKey('type', $this->Json->fileToArray($file));
    }

    /**
     * Get external JSON file and save as array.
     *
     * @since 1.1.3
     */
    public function testExternalFileNonExistentToArray()
    {
        $file = 'https://raw.githubusercontent.com/composer.json';

        $this->assertFalse($this->Json->fileToArray($file));
    }
}
