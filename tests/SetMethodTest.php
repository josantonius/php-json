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
use Josantonius\Json\Exceptions\CreateFileException;
use Josantonius\Json\Exceptions\NoIterableFileException;
use Josantonius\Json\Exceptions\CreateDirectoryException;
use Josantonius\Json\Exceptions\NoIterableElementException;

class SetMethodTest extends TestCase
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

    public function test_should_allow_set_any_type_of_data(): void
    {
        $jsonFile = new Json($this->filepath);

        $value = ['foo' => 'bar'];
        $result = $jsonFile->set($value);
        $this->assertEquals($value, $result);

        $value = ['foo', 'bar'];
        $result = $jsonFile->set($value);
        $this->assertEquals($value, $result);

        $value = ['foo' => 'bar'];
        $result = $jsonFile->set((object) $value);
        $this->assertEquals($value, $result);

        $value = false;
        $result = $jsonFile->set($value);
        $this->assertEquals($value, $result);

        $value = 8;
        $result = $jsonFile->set($value);
        $this->assertEquals($value, $result);

        $value = 'foo';
        $result = $jsonFile->set($value);
        $this->assertEquals($value, $result);

        $value = null;
        $result = $jsonFile->set($value);
        $this->assertEquals($value, $result);
    }

    public function test_should_set_the_content_for_a_specific_level_from_dot_notation(): void
    {
        $jsonFile = new Json($this->filepath);

        $jsonFile->set(['foo' => ['bar']]);

        $result = $jsonFile->set('baz', 'foo.1');

        $this->assertEquals(['foo' => ['bar', 'baz']], $result);

        $jsonFile->set([[]]);

        $result = $jsonFile->set('foo', '0.0');

        $this->assertEquals([['foo']], $result);

        $result = $jsonFile->set('foo', 0);

        $this->assertEquals(['foo'], $result);
    }

    public function test_should_fail_if_filename_is_wrong(): void
    {
        $this->expectException(CreateFileException::class);

        $jsonFile = new Json('/file:name.json');

        $jsonFile->set();
    }

    public function test_should_fail_if_path_is_wrong(): void
    {
        $jsonFile = new Json('/foo:/filename.json');

        $this->expectException(CreateDirectoryException::class);

        $jsonFile->set();
    }

    public function test_should_fail_if_the_file_does_not_exists(): void
    {
        $jsonFile = new Json($this->filepath);

        $this->expectException(GetFileException::class);

        $jsonFile->set(['foo'], 'bar');
    }

    public function test_should_fail_when_there_are_json_errors_in_the_file(): void
    {
        $jsonFile = new Json($this->filepath);

        file_put_contents($this->filepath, '{');

        $this->expectException(JsonErrorException::class);

        $jsonFile->set(['foo'], 'bar');
    }

    public function test_should_fail_if_the_file_does_not_contain_an_array(): void
    {
        $jsonFile = new Json($this->filepath);

        $jsonFile->set('foo');

        $this->expectException(NoIterableElementException::class);

        $jsonFile->set(true, 'bar');
    }
}
