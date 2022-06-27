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

use Josantonius\Json\Exception\UnavailableMethodException;
use Josantonius\Json\Json;
use PHPUnit\Framework\TestCase;

class SetMethodTest extends TestCase
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

    public function testShouldSetArrayOnJsonFile(): void
    {
        $jsonFile = new Json($this->filepath);

        $array = ['foo' => 'bar'];

        $jsonFile->set($array);

        $this->assertEquals($array, json_decode(file_get_contents($this->filepath), true));
    }

    public function testShouldSetObjectOnJsonFile(): void
    {
        $jsonFile = new Json($this->filepath);

        $object = (object) ['foo' => 'bar'];

        $jsonFile->set($object);

        $this->assertEquals($object, json_decode(file_get_contents($this->filepath)));
    }


    public function testShouldThrowExceptionIfSetMethodIsUsedWithRemoteFile(): void
    {
        $jsonFile = new Json($this->url);

        $this->expectException(UnavailableMethodException::class);

        $jsonFile->set(['foo' => 'bar']);
    }
}
