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

class PushMethodTest extends TestCase
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

    public function test_should_push_array_on_json_file(): void
    {
        $jsonFile = new Json($this->filepath);

        $jsonFile->set([['foo' => 'bar']]);

        $jsonFile->push(['bar' => 'foo']);

        $this->assertEquals(
            [['foo' => 'bar'], ['bar' => 'foo']],
            json_decode(file_get_contents($this->filepath), true)
        );
    }

    public function test_should_push_object_on_json_file(): void
    {
        $jsonFile = new Json($this->filepath);

        $jsonFile->set([['foo' => 'bar']]);

        $jsonFile->push((object) ['bar' => 'foo']);

        $this->assertEquals(
            [['foo' => 'bar'], ['bar' => 'foo']],
            json_decode(file_get_contents($this->filepath), true)
        );
    }

    public function test_should_throw_exception_if_push_method_is_used_with_remote_file(): void
    {
        $jsonFile = new Json($this->url);

        $this->expectException(UnavailableMethodException::class);

        $jsonFile->push(['bar' => 'foo']);
    }

    public function test_should_fail_if_the_file_does_not_exists(): void
    {
        $jsonFile = new Json($this->filepath);

        $this->expectException(GetFileException::class);

        $jsonFile->push((object) ['bar' => 'foo']);
    }

    public function test_should_throw_exception_if_remote_file_cannot_be_obtained(): void
    {
        $jsonFile = new Json($this->url . 'wrong');

        $this->expectException(GetFileException::class);

        $jsonFile->push((object) ['bar' => 'foo']);
    }

    public function test_should_throw_exception_when_there_are_json_errors_in_the_file(): void
    {
        $jsonFile = new Json($this->filepath);

        file_put_contents($this->filepath, '{');

        $this->expectException(JsonErrorException::class);

        $jsonFile->push((object) ['bar' => 'foo']);
    }
}
