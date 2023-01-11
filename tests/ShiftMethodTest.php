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

class ShiftMethodTest extends TestCase
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

    public function test_should_shift_element(): void
    {
        $jsonFile = new Json($this->filepath);

        $jsonFile->set([1, 2, 3]);

        $value = $jsonFile->shift();

        $this->assertEquals(1, $value);
        $this->assertEquals([2, 3], $jsonFile->get());
    }

    public function test_should_shift_element_from_dot(): void
    {
        $jsonFile = new Json($this->filepath);

        $jsonFile->set(['foo' => [1, 2, 3]]);

        $value = $jsonFile->shift('foo');

        $this->assertEquals(1, $value);
        $this->assertEquals(['foo' => [2, 3]], $jsonFile->get());
    }

    public function test_should_return_null_if_the_array_is_empty(): void
    {
        $jsonFile = new Json($this->filepath);

        $jsonFile->set([]);

        $value = $jsonFile->shift();

        $this->assertNull($value);
    }


    public function test_should_fail_if_the_file_does_not_contain_an_array()
    {
        $jsonFile = new Json($this->filepath);

        $jsonFile->set('foo');

        $this->expectException(NoIterableFileException::class);

        $jsonFile->pop();
    }

    public function test_should_fail_if_the_dot_path_does_not_contain_an_array()
    {
        $jsonFile = new Json($this->filepath);

        $jsonFile->set(['foo' => null]);

        $this->expectException(NoIterableElementException::class);

        $jsonFile->shift('foo');
    }

    public function test_should_fail_if_the_file_does_not_exists(): void
    {
        $jsonFile = new Json($this->filepath);

        $this->expectException(GetFileException::class);

        $jsonFile->shift();
    }

    public function test_should_fail_when_there_are_json_errors_in_the_file(): void
    {
        $jsonFile = new Json($this->filepath);

        file_put_contents($this->filepath, '{');

        $this->expectException(JsonErrorException::class);

        $jsonFile->shift();
    }
}
