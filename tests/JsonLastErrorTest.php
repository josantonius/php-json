<?php
/**
 * PHP simple library for managing Json files.
 *
 * @author    Josantonius <hello@josantonius.com>
 * @copyright 2016 - 2018 (c) Josantonius - PHP-Json
 * @license   https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @link      https://github.com/Josantonius/PHP-Json
 * @since     1.1.7
 */
namespace Josantonius\Json;

use PHPUnit\Framework\TestCase;

/**
 * Tests class for JsonLastError class.
 */
class JsonLastErrorTest extends TestCase
{
    /**
     * Json instance.
     *
     * @var object
     */
    protected $jsonLastError;

    /**
     * Set up.
     */
    public function setUp()
    {
        parent::setUp();

        $this->jsonLastError = new JsonLastError;
    }

    /**
     * Check if it is an instance of Json.
     */
    public function testIsInstanceOfJson()
    {
        $this->assertInstanceOf('Josantonius\Json\JsonLastError', $this->jsonLastError);
    }

    /**
     * Get collection of JSON errors.
     */
    public function testGetCollection()
    {
        $jsonLastError = $this->jsonLastError;

        $this->assertInternalType('array', $jsonLastError::getCollection());
    }

    /**
     * Check for errors.
     */
    public function testCheckJsonLastError()
    {
        $jsonLastError = $this->jsonLastError;

        $this->assertNull($jsonLastError::check());
    }
}
