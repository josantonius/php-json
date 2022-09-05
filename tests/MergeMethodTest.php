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
use Josantonius\Json\Exceptions\UnavailableMethodException;

class MergeMethodTest extends TestCase
{
    private string $filepath =  __DIR__ . '/filename.json';

    private string $url = 'https://raw.githubusercontent.com/josantonius/php-json/main/composer.json';

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

        $jsonFile->merge(['bar' => 'foo']);

        $this->assertEquals([
            'foo' => 'bar',
            'bar' => 'foo'
        ], json_decode(file_get_contents($this->filepath), true));
    }

    public function test_should_merge_object_on_json_file(): void
    {
        $jsonFile = new Json($this->filepath);

        $jsonFile->set(['foo' => 'bar']);

        $object = (object) ['bar' => 'foo'];

        $jsonFile->merge($object);

        $this->assertEquals([
            'foo' => 'bar',
            'bar' => 'foo'
        ], json_decode(file_get_contents($this->filepath), true));
    }

    public function test_should_fail_if_the_file_does_not_exists(): void
    {
        $jsonFile = new Json($this->filepath);

        $this->expectException(GetFileException::class);

        $jsonFile->merge((object) ['bar' => 'foo']);
    }

    public function test_should_throw_exception_if_merge_method_is_used_with_remote_file(): void
    {
        $jsonFile = new Json($this->url);

        $this->expectException(UnavailableMethodException::class);

        $jsonFile->merge(['bar' => 'foo']);
    }

    public function test_should_throw_exception_when_there_are_json_errors_in_the_file(): void
    {
        $jsonFile = new Json($this->filepath);

        file_put_contents($this->filepath, '{');

        $this->expectException(JsonErrorException::class);

        $jsonFile->merge(['bar' => 'foo']);
    }
}
