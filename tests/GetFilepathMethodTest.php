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

class GetFilepathMethodTest extends TestCase
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

    public function test_should_get_the_path_to_a_local_file(): void
    {
        $jsonFile = new Json($this->filepath);

        $this->assertEquals($this->filepath, $jsonFile->getFilepath());
    }

    public function test_should_get_the_path_to_a_remote_file(): void
    {
        $jsonFile = new Json($this->url);

        $this->assertEquals($this->url, $jsonFile->getFilepath());
    }
}
