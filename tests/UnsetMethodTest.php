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

class UnsetMethodTest extends TestCase
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

    public function test_should_unset_element(): void
    {
        $jsonFile = new Json($this->filepath);

        $jsonFile->set([1, 2, 3]);

        $value = $jsonFile->unset(2);

        $this->assertEquals([1, 2], $value);

        $jsonFile->set(['foo' => 'bar']);

        $value = $jsonFile->unset('foo');

        $this->assertEquals([], $value);
    }

    public function test_should_fail_if_the_file_does_not_contain_an_array()
    {
        $jsonFile = new Json($this->filepath);

        $jsonFile->set('foo');

        $this->expectException(NoIterableFileException::class);

        $jsonFile->unset('foo');
    }

    public function test_should_fail_if_the_file_does_not_exists(): void
    {
        $jsonFile = new Json($this->filepath);

        $this->expectException(GetFileException::class);

        $jsonFile->unset('foo');
    }

    public function test_should_fail_when_there_are_json_errors_in_the_file(): void
    {
        $jsonFile = new Json($this->filepath);

        file_put_contents($this->filepath, '{');

        $this->expectException(JsonErrorException::class);

        $jsonFile->unset('foo');
    }
}
