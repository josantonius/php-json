<?php

declare(strict_types=1);

/**
 * PHP simple library for managing JSON files.
 *
 * @author    Josantonius <hello@josantonius.dev>
 * @copyright 2016 (c) Josantonius
 * @license   https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @link      https://github.com/josantonius/php-json
 * @since     1.1.3
 */
namespace Josantonius\Json\Tests;

use Josantonius\Json\Exception\CreateDirectoryException;
use Josantonius\Json\Exception\CreateFileException;
use Josantonius\Json\Exception\GetFileException;
use Josantonius\Json\Exception\JsonErrorException;
use Josantonius\Json\Exception\UnavailableMethodException;
use Josantonius\Json\Json;
use PHPUnit\Framework\TestCase;

class JsonTest extends TestCase
{
    /**
     * @since 2.0.0
     */
    private string $filepath =  __DIR__ . '/filename.json';

    /**
     * @since 2.0.0
     */
    private string $url = 'https://raw.githubusercontent.com/josantonius/php-json/main/composer.json';

    /**
     * @since 1.1.6
     */
    public function setUp(): void
    {
        parent::setup();
    }

    /**
     * @since 2.0.0
     */
    public function tearDown(): void
    {
        if (file_exists($this->filepath)) {
            unlink($this->filepath);
        }
    }

    /**
     * @test
     * @since 2.0.0
     */
    public function itShouldReturnValidInstance(): void
    {
        $this->assertInstanceOf(Json::class, new Json($this->filepath));
    }

    /**
     * @test
     * @since 2.0.0
     */
    public function constructorShouldCreateTheFileIfNotExist(): void
    {
        $this->assertFalse(file_exists($this->filepath));
        
        new Json($this->filepath);
        
        $this->assertTrue(file_exists($this->filepath));

        $this->assertEquals('[]', file_get_contents($this->filepath));
    }

    /**
     * @test
     * @since 2.0.0
     */
    public function constructorShouldThrowExceptionIfPathIsWrong(): void
    {
        $this->expectException(CreateDirectoryException::class);

        new Json('/foo:/filename.json');
    }

    /**
     * @test
     * @since 2.0.0
     */
    public function constructorShouldThrowExceptionIfFilenameIsWrong(): void
    {
        $this->expectException(CreateFileException::class);
    
        new Json('/file:name.json');
    }

    /**
     * @test
     * @since 2.0.0
     */
    public function itShouldGetFileContents(): void
    {
        $jsonFile = new Json($this->filepath);

        $this->assertEquals([], $jsonFile->get());
    }

    /**
     * @test
     * @since 2.0.0
     */
    public function itShouldGetRemoteFileContents(): void
    {
        $jsonFile = new Json($this->url);

        $this->assertArrayHasKey('name', $jsonFile->get());
    }

    /**
     * @test
     * @since 2.0.0
     */
    public function itShouldSetArrayOnJsonFile(): void
    {
        $jsonFile = new Json($this->filepath);

        $array = ['foo' => 'bar'];

        $jsonFile->set($array);

        $this->assertEquals($array, json_decode(file_get_contents($this->filepath), true));
    }

    /**
     * @test
     * @since 2.0.0
     */
    public function itShouldSetObjectOnJsonFile(): void
    {
        $jsonFile = new Json($this->filepath);

        $object = (object) ['foo' => 'bar'];

        $jsonFile->set($object);

        $this->assertEquals($object, json_decode(file_get_contents($this->filepath)));
    }

    /**
     * @test
     * @since 2.0.0
     */
    public function itShouldThrowExceptionIfSetMethodIsUsedWithRemoteFile(): void
    {
        $jsonFile = new Json($this->url);

        $this->expectException(UnavailableMethodException::class);

        $jsonFile->set(['foo' => 'bar']);
    }

    /**
     * @test
     * @since 2.0.0
     */
    public function itShouldMergeArrayOnJsonFile(): void
    {
        $jsonFile = new Json($this->filepath);

        $jsonFile->set(['foo' => 'bar']);

        $jsonFile->merge(['bar' => 'foo']);

        $this->assertEquals([
            'foo' => 'bar',
            'bar' => 'foo'
        ], json_decode(file_get_contents($this->filepath), true));
    }

    /**
     * @test
     * @since 2.0.0
     */
    public function itShouldMergeObjectOnJsonFile(): void
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

    /**
     * @test
     * @since 2.0.0
     */
    public function itShouldThrowExceptionIfMergeMethodIsUsedWithRemoteFile(): void
    {
        $jsonFile = new Json($this->url);

        $this->expectException(UnavailableMethodException::class);

        $jsonFile->merge(['bar' => 'foo']);
    }

    /**
     * @test
     * @since 2.0.0
     */
    public function itShouldPushArrayOnJsonFile(): void
    {
        $jsonFile = new Json($this->filepath);

        $jsonFile->set([['foo' => 'bar']]);

        $jsonFile->push(['bar' => 'foo']);

        $this->assertEquals(
            [['foo' => 'bar'], ['bar' => 'foo']],
            json_decode(file_get_contents($this->filepath), true)
        );
    }

    /**
     * @test
     * @since 2.0.0
     */
    public function itShouldPushObjectOnJsonFile(): void
    {
        $jsonFile = new Json($this->filepath);

        $jsonFile->set([['foo' => 'bar']]);

        $jsonFile->push((object) ['bar' => 'foo']);

        $this->assertEquals(
            [['foo' => 'bar'], ['bar' => 'foo']],
            json_decode(file_get_contents($this->filepath), true)
        );
    }

    /**
     * @test
     * @since 2.0.0
     */
    public function itShouldThrowExceptionIfPushMethodIsUsedWithRemoteFile(): void
    {
        $jsonFile = new Json($this->url);

        $this->expectException(UnavailableMethodException::class);

        $jsonFile->push(['bar' => 'foo']);
    }

    /**
     * @test
     * @since 2.0.0
     */
    public function itShouldThrowExceptionIfFileCannotBeObtained(): void
    {
        $jsonFile = new Json($this->filepath);
        
        unlink($this->filepath);

        $this->expectException(GetFileException::class);

        $jsonFile->push((object) ['bar' => 'foo']);
    }


    /**
     * @test
     * @since 2.0.0
     */
    public function itShouldThrowExceptionIfRemoteFileCannotBeObtained(): void
    {
        $jsonFile = new Json($this->url . 'wrong');

        $this->expectException(GetFileException::class);

        $jsonFile->push((object) ['bar' => 'foo']);
    }

    /**
     * @test
     * @since 2.0.0
     */
    public function itShouldThrowExceptionWhenThereAreJsonErrorsInTheFile(): void
    {
        $jsonFile = new Json($this->filepath);

        file_put_contents($this->filepath, '{');

        $this->expectException(JsonErrorException::class);

        $jsonFile->get();
    }

    /**
     * @test
     * @since 2.0.0
     */
    public function arrayToFileStaticMethodShouldBehaveLikeTheSetMethod()
    {
        $json = new Json($this->filepath);

        $json->arrayToFile(['foo' => 'bar'], $this->filepath);
        
        $this->assertEquals(['foo' => 'bar'], json_decode(
            file_get_contents($this->filepath),
            true
        ));
    }

    /**
     * @test
     * @since 2.0.0
     */
    public function fileToArrayStaticMethodShouldBehaveLikeTheGetMethod()
    {
        $json = new Json($this->filepath);

        $this->assertEquals($json->fileToArray($this->filepath), $json->get());
    }
}
