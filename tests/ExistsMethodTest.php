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

class ExistsMethodTest extends TestCase
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

    public function test_should_check_if_a_file_exists(): void
    {
        $jsonFile = new Json('foo.json');

        $this->assertFalse($jsonFile->exists());

        $jsonFile = new Json($this->filepath);

        $jsonFile->set();

        $this->assertTrue($jsonFile->exists());
    }
}
