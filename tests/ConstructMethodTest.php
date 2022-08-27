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
use Josantonius\Json\Exceptions\CreateFileException;
use Josantonius\Json\Exceptions\CreateDirectoryException;

class ConstructMethodTest extends TestCase
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

    public function test_should_create_the_file_if_not_exist(): void
    {
        $this->assertFalse(file_exists($this->filepath));

        new Json($this->filepath);

        $this->assertTrue(file_exists($this->filepath));

        $this->assertEquals('[]', file_get_contents($this->filepath));
    }

    public function test_should_throw_exception_if_path_is_wrong(): void
    {
        $this->expectException(CreateDirectoryException::class);

        new Json('/foo:/filename.json');
    }

    public function test_should_throw_exception_if_filename_is_wrong(): void
    {
        $this->expectException(CreateFileException::class);

        new Json('/file:name.json');
    }
}
