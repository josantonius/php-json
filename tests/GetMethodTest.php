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

use Josantonius\Json\Json;
use PHPUnit\Framework\TestCase;
use Josantonius\Json\Exceptions\JsonErrorException;

class GetMethodTest extends TestCase
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

    public function testShouldGetFileContents(): void
    {
        $jsonFile = new Json($this->filepath);

        $this->assertEquals([], $jsonFile->get());
    }

    public function testShouldGetRemoteFileContents(): void
    {
        $jsonFile = new Json($this->url);

        $this->assertArrayHasKey('name', $jsonFile->get());
    }

    public function testShouldThrowExceptionWhenThereAreJsonErrorsInTheFile(): void
    {
        $jsonFile = new Json($this->filepath);

        file_put_contents($this->filepath, '{');

        $this->expectException(JsonErrorException::class);

        $jsonFile->get();
    }
}
