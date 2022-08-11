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

    public function testShouldMergeArrayOnJsonFile(): void
    {
        $jsonFile = new Json($this->filepath);

        $jsonFile->set(['foo' => 'bar']);

        $jsonFile->merge(['bar' => 'foo']);

        $this->assertEquals([
            'foo' => 'bar',
            'bar' => 'foo'
        ], json_decode(file_get_contents($this->filepath), true));
    }

    public function testShouldMergeObjectOnJsonFile(): void
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

    public function testShouldThrowExceptionIfMergeMethodIsUsedWithRemoteFile(): void
    {
        $jsonFile = new Json($this->url);

        $this->expectException(UnavailableMethodException::class);

        $jsonFile->merge(['bar' => 'foo']);
    }
}
