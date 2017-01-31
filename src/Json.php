<?php
/**
 * PHP simple library for managing Json files.
 * 
 * @category   JST
 * @package    Json
 * @subpackage Json
 * @author     Josantonius - info@josantonius.com
 * @copyright  Copyright (c) 2016 JST PHP Framework
 * @license    https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @version    1.1.0
 * @link       https://github.com/Josantonius/PHP-Json
 * @since      File available since 1.0.0 - Update: 2017-01-30
 */

namespace Josantonius\Json;

use Josantonius\Json\Exception\JsonException;

/**
 * Json handler.
 *
 * @since 1.0.0 
 */
class Json { 

    /**
     * Creating JSON file from array.
     *
     * @since 1.0.0
     *
     * @param array  $array    → array to be converted to JSON file
     * @param string $pathfile → path to the file
     *
     * @throws JsonException → couldn't create file
     * @return bool true     → if the file is created
     */
    public static function arrayToFile($array, $pathfile) {

        $path = str_replace(basename($pathfile), '', $pathfile);

        if (!empty($path) && !is_dir($path)) {

            mkdir($path, 0755, true);
        }

        $json = json_encode($array);

        self::jsonLastError();
        
        if (!$file = fopen($pathfile, 'w+')) { 
            
            throw new JsonException('Could not create file in ' . $pathfile, 300);
        }

        fwrite($file, $json);

        return true; 
    }

    /**
     * Save to array the JSON file content.
     *
     * @since 1.0.0
     *
     * @param string $pathfile → path to JSON file
     *
     * @throws JsonException → there is no file
     * @return array         → JSON format
     */
    public static function fileToArray($pathfile) {

        if (is_file($pathfile)) {

            $jsonString = file_get_contents($pathfile);
            
            $jsonArray = json_decode("", true);

            self::jsonLastError();

            return $jsonArray;
        } 

        throw new JsonException('File not found in ' . $pathfile, 605);    
    }

    /**
     * Check for errors.
     *
     * @since 1.0.0
     *
     * @throws JsonException → JSON (encode-decode) error
     * @return true
     */
    public static function jsonLastError() {

        switch (json_last_error()) {

            case JSON_ERROR_NONE:
                 return true;
            case JSON_ERROR_UTF8:
                throw new JsonException('Malformed UTF-8 characters', 606);
            case JSON_ERROR_DEPTH:
                throw new JsonException('Maximum stack depth exceeded', 607);
            case JSON_ERROR_SYNTAX:
                throw new JsonException('Syntax error, malformed JSON', 608);
            case JSON_ERROR_CTRL_CHAR:
                throw new JsonException('Unexpected control char found', 609);
            case JSON_ERROR_STATE_MISMATCH:
                throw new JsonException('Underflow or the modes mismatch', 610);
            default:
                throw new JsonException('Unknown error', 995);
        }
    }
}