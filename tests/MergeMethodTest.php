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

class MergeMethodTest extends TestCase
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

    public function test_should_merge_array_on_json_file(): void
    {
        $jsonFile = new Json($this->filepath);

        $jsonFile->set(['foo' => 'bar']);

        $result = $jsonFile->merge(['bar' => 'foo']);

        $this->assertEquals([
            'foo' => 'bar',
            'bar' => 'foo'
        ], $result);
    }

    public function test_should_merge_object_on_json_file(): void
    {
        $jsonFile = new Json($this->filepath);

        $jsonFile->set(['foo' => 'bar']);

        $result = $jsonFile->merge((object) ['bar' => 'foo']);

        $this->assertEquals([
            'foo' => 'bar',
            'bar' => 'foo'
        ], $result);
    }

    public function test_should_merge_the_content_for_a_specific_level_from_dot_notation(): void
    {
        $jsonFile = new Json($this->filepath);

        $jsonFile->set(['foo' => ['bar' => 'baz']]);

        $result = $jsonFile->merge((object) ['baz' => 'bar'], 'foo');

        $this->assertEquals(['foo' => [
            'bar' => 'baz',
            'baz' => 'bar'
        ]], $result);

        $jsonFile->set(['foo' => [['bar']]]);

        $result = $jsonFile->merge(['baz'], 'foo.0');

        $this->assertEquals(['foo' => [
            ['bar', 'baz']
        ]], $result);

        $jsonFile->set([['foo'], ['bar']]);

        $result = $jsonFile->merge(['baz'], 1);

        $this->assertEquals([
            ['foo'],
            ['bar', 'baz'],
        ], $result);
    }

    public function test_should_fail_if_the_file_does_not_exists(): void
    {
        $jsonFile = new Json($this->filepath);

        $this->expectException(GetFileException::class);

        $jsonFile->merge((object) ['bar' => 'foo']);
    }

    public function test_should_fail_when_there_are_json_errors_in_the_file(): void
    {
        $jsonFile = new Json($this->filepath);

        file_put_contents($this->filepath, '{');

        $this->expectException(JsonErrorException::class);

        $jsonFile->merge(['bar' => 'foo']);
    }

    public function test_should_fail_if_the_dot_path_does_not_contain_an_array(): void
    {
        $jsonFile = new Json($this->filepath);

        $jsonFile->set(['foo' => null]);

        $this->expectException(NoIterableElementException::class);

        $jsonFile->merge(['bar'], 'foo');
    }

    public function test_should_fail_if_the_file_does_not_contain_an_array(): void
    {
        $jsonFile = new Json($this->filepath);

        $jsonFile->set('foo');

        $this->expectException(NoIterableFileException::class);

        $jsonFile->merge(['bar'], 'foo');
    }
}
