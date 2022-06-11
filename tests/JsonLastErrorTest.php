<?php

/**
 * PHP simple library for managing JSON files.
 *
 * @author    Josantonius <hello@josantonius.dev>
 * @copyright 2016 (c) Josantonius
 * @license   https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @link      https://github.com/josantonius/php-json
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
     * JSON instance.
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
     * Check if it is an instance of JSON.
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
