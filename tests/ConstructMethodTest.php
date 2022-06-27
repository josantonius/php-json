<?php

declare(strict_types=1);

/*
 * This file is part of https://github.com/josantonius/php-json repository.
 *
 * (c) Josantonius <hello@josantonius.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Josantonius\Json\Tests;

use Josantonius\Json\Exception\CreateDirectoryException;
use Josantonius\Json\Exception\CreateFileException;
use Josantonius\Json\Json;
use PHPUnit\Framework\TestCase;

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

    public function testShouldCreateTheFileIfNotExist(): void
    {
        $this->assertFalse(file_exists($this->filepath));

        new Json($this->filepath);

        $this->assertTrue(file_exists($this->filepath));

        $this->assertEquals('[]', file_get_contents($this->filepath));
    }

    public function testShouldThrowExceptionIfPathIsWrong(): void
    {
        $this->expectException(CreateDirectoryException::class);

        new Json('/foo:/filename.json');
    }

    public function testShouldThrowExceptionIfFilenameIsWrong(): void
    {
        $this->expectException(CreateFileException::class);

        new Json('/file:name.json');
    }
}
