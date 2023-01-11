<?php

/*
 * This file is part of https://github.com/josantonius/php-json repository.
 *
 * (c) Josantonius <hello@josantonius.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @phpcs:disable PSR1.Methods.CamelCapsMethodName.NotCamelCaps
 */

namespace Josantonius\Json\Tests;

use Josantonius\Json\Json;
use PHPUnit\Framework\TestCase;
use Josantonius\Json\Exceptions\GetFileException;
use Josantonius\Json\Exceptions\JsonErrorException;

class GetMethodTest extends TestCase
{
    protected string $filepath =  __DIR__ . '/filename.json';

    protected function setUp(): void
    {
        parent::setup();
    }

    protected function tearDown(): void
    {
        if (file_exists($this->filepath)) {
            unlink($this->filepath);
        }
    }

    public function test_should_get_file_contents_as_associative_array(): void
    {
        $jsonFile = new Json($this->filepath);

        $value = ['foo' => 'bar'];

        file_put_contents($this->filepath, json_encode($value));

        $content = $jsonFile->get();

        $this->assertEquals($value, $content);
    }

    public function test_should_get_file_contents_as_numeric_array(): void
    {
        $jsonFile = new Json($this->filepath);

        $value = ['foo', 'bar'];

        file_put_contents($this->filepath, json_encode($value));

        $content = $jsonFile->get();

        $this->assertEquals($value, $content);
    }

    public function test_should_get_file_contents_as_object(): void
    {
        $jsonFile = new Json($this->filepath);

        $value = ['foo' => 'bar'];

        file_put_contents($this->filepath, json_encode($value));

        $content = $jsonFile->get(asObject: true);

        $this->assertEquals((object) $value, $content);
    }

    public function test_should_get_file_contents_as_boolean(): void
    {
        $jsonFile = new Json($this->filepath);

        $value = false;

        file_put_contents($this->filepath, json_encode($value));

        $content = $jsonFile->get();

        $this->assertEquals($value, $content);
    }

    public function test_should_get_file_contents_as_integer(): void
    {
        $jsonFile = new Json($this->filepath);

        $value = 8;

        file_put_contents($this->filepath, json_encode($value));

        $content = $jsonFile->get();

        $this->assertEquals($value, $content);
    }

    public function test_should_get_file_contents_as_string(): void
    {
        $jsonFile = new Json($this->filepath);

        $value = 'foo';

        file_put_contents($this->filepath, json_encode($value));

        $content = $jsonFile->get();

        $this->assertEquals($value, $content);
    }

    public function test_should_get_file_contents_as_null(): void
    {
        $jsonFile = new Json($this->filepath);

        $value = null;

        file_put_contents($this->filepath, json_encode($value));

        $content = $jsonFile->get();

        $this->assertNull($content);
    }

    public function test_should_fail_if_the_file_does_not_exists(): void
    {
        $jsonFile = new Json($this->filepath);

        $this->expectException(GetFileException::class);

        $jsonFile->get();
    }

    public function test_should_fail_when_there_are_json_errors_in_the_file(): void
    {
        $jsonFile = new Json($this->filepath);

        file_put_contents($this->filepath, '{');

        $this->expectException(JsonErrorException::class);

        $jsonFile->get();
    }
}
