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
use Josantonius\Json\Exceptions\NoIterableFileException;
use Josantonius\Json\Exceptions\NoIterableElementException;

class UnshiftMethodTest extends TestCase
{
    private string $filepath =  __DIR__ . '/filename.json';

    public function setUp(): void
    {
        parent::setup();
    }

    public function tearDown(): void
    {
        if (file_exists($this->filepath)) {
            unlink($this->filepath);
        }
    }

    public function test_should_unshift_array_on_json_file(): void
    {
        $jsonFile = new Json($this->filepath);

        $jsonFile->set([['foo' => 'bar']]);

        $jsonFile->unshift(['bar' => 'foo']);

        $this->assertEquals(
            [
                ['bar' => 'foo'], ['foo' => 'bar'],
            ],
            json_decode(file_get_contents($this->filepath), true)
        );
    }

    public function test_should_unshift_object_on_json_file(): void
    {
        $jsonFile = new Json($this->filepath);

        $jsonFile->set([['foo' => 'bar']]);

        $jsonFile->unshift((object) ['bar' => 'foo']);

        $this->assertEquals(
            [['bar' => 'foo'], ['foo' => 'bar']],
            json_decode(file_get_contents($this->filepath), true)
        );
    }

    public function test_should_unshift_the_content_for_a_specific_level_from_dot_notation(): void
    {
        $jsonFile = new Json($this->filepath);

        $jsonFile->set(['foo' => [['bar' => 'baz']]]);

        $result = $jsonFile->unshift(['baz' => 'bar'], 'foo');

        $this->assertEquals(['foo' => [
            ['baz' => 'bar'], ['bar' => 'baz']
        ]], $result);

        $jsonFile->set(['foo' => [[['bar']]]]);

        $result = $jsonFile->unshift(['baz'], 'foo.0');

        $this->assertEquals(['foo' => [[
            ['baz'], ['bar'],
        ]]], $result);

        $jsonFile->set([['foo'], ['bar']]);

        $result = $jsonFile->unshift('baz', 1);

        $this->assertEquals([['foo'], ['baz', 'bar']], $result);
    }

    public function test_should_fail_if_the_file_does_not_exists(): void
    {
        $jsonFile = new Json($this->filepath);

        $this->expectException(GetFileException::class);

        $jsonFile->unshift((object) ['bar' => 'foo']);
    }

    public function test_should_throw_exception_when_there_are_json_errors_in_the_file(): void
    {
        $jsonFile = new Json($this->filepath);

        file_put_contents($this->filepath, '{');

        $this->expectException(JsonErrorException::class);

        $jsonFile->unshift((object) ['bar' => 'foo']);
    }

    public function test_should_fail_if_the_dot_path_does_not_contain_an_array(): void
    {
        $jsonFile = new Json($this->filepath);

        $jsonFile->set(['foo' => null]);

        $this->expectException(NoIterableElementException::class);

        $jsonFile->unshift(['bar'], 'foo');
    }

    public function test_should_fail_if_the_file_does_not_contain_an_array(): void
    {
        $jsonFile = new Json($this->filepath);

        $jsonFile->set('foo');

        $this->expectException(NoIterableFileException::class);

        $jsonFile->unshift(['bar'], 'foo');
    }

    public function test_should_fail_if_the_index_does_not_exist(): void
    {
        $jsonFile = new Json($this->filepath);

        $jsonFile->set();

        $this->expectException(NoIterableElementException::class);

        $jsonFile->unshift('bar', 'foo');
    }
}
