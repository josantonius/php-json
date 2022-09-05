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
use Josantonius\Json\Exceptions\UnavailableMethodException;

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

    public function test_should_set_array_on_json_file(): void
    {
        $jsonFile = new Json($this->filepath);

        $array = ['foo' => 'bar'];

        $jsonFile->set($array);

        $this->assertEquals($array, json_decode(file_get_contents($this->filepath), true));
    }

    public function test_should_set_object_on_json_file(): void
    {
        $jsonFile = new Json($this->filepath);

        $object = (object) ['foo' => 'bar'];

        $jsonFile->set($object);

        $this->assertEquals($object, json_decode(file_get_contents($this->filepath)));
    }

    public function test_should_throw_exception_if_filename_is_wrong(): void
    {
        $this->expectException(CreateFileException::class);

        $jsonFile = new Json('/file:name.json');

        $jsonFile->set();
    }

    public function test_should_throw_exception_if_set_method_is_used_with_remote_file(): void
    {
        $jsonFile = new Json($this->url);

        $this->expectException(UnavailableMethodException::class);

        $jsonFile->set(['foo' => 'bar']);
    }
}
