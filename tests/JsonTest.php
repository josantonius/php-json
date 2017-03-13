<?php 
/**
 * PHP simple library for managing Json files.
 * 
 * @author     Josantonius - hola@josantonius.com
 * @copyright  Copyright (c) 2016 - 2017
 * @license    https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @link       https://github.com/Josantonius/PHP-Json
 * @since      1.0.0
 */

namespace Josantonius\Json\Tests;

use Josantonius\Json\Json;

/**
 * Tests class for Json library.
 *
 * @since 1.0.0
 */
class JsonTest { 

    /**
     * Creating JSON file from array.
     */
    public static function testArrayToFile() {

        $array = [
            'name'  => 'Josantonius',
            'email' => 'info@josantonius.com',
            'url'   => 'https://github.com/josantonius/PHP-Json'
        ];

        $file = __DIR__ . '/resources/filename.json';
        
        echo '<pre>'; var_dump(Json::arrayToFile($file, $array)); echo '</pre>';
    }

    /**
     * Error to creating JSON file from array.
     */
    public static function testArrayToFileError() {

        $array = ['name'  => 'Josantonius'];

        $pathfile = __DIR__ . '';
        
        Json::arrayToFile($pathfile, $array);
    }

    /**
     * Save to array the JSON file content.
     */
    public static function testFileToArray() {

        $pathfile = __DIR__ . '/resources/example.json';

        echo '<pre>'; var_dump(Json::fileToArray($pathfile)); echo '</pre>';
    }

    /**
     * Error when file doesn't exist.
     */
    public static function testFileToArrayError() {

        $pathfile = __DIR__ . '';

        Json::fileToArray($pathfile);
    }
}