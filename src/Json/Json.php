<?php 
/**
 * PHP simple library for managing Json files.
 * 
 * @author     Josantonius - hello@josantonius.com
 * @copyright  Copyright (c) 2016 - 2017
 * @license    https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @link       https://github.com/Josantonius/PHP-Json
 * @since      1.0.0
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
     * @param array  $array → array to be converted to JSON
     * @param string $file  → path to the file
     *
     * @return boolean → true if the file is created without errors
     */
    public static function arrayToFile($array, $file) {

        self::_createDirectory($file);

        $json = json_encode($array, JSON_PRETTY_PRINT);

        $json = self::_jsonLastError() ? json_encode($json, 128) : $json;

        self::_saveFile($file, $json);

        return (!isset($json['error-code'])); 
    }

    /**
     * Save to array the JSON file content.
     *
     * @since 1.0.0
     *
     * @param string $file → path or external url to JSON file
     *
     * @return array|false
     */
    public static function fileToArray($file) {

        if (!is_file($file) && !filter_var($file, FILTER_VALIDATE_URL)) {

            self::arrayToFile([], $file);
        }

        $jsonString = @file_get_contents($file);
            
        $array = json_decode($jsonString, true);
        
        $error = self::_jsonLastError();


        return $array===null || isset($error['error-code']) ? false : $array;
    }

    /**
     * Create directory recursively if it doesn't exist.
     *
     * @since 1.1.3
     *
     * @param string $file → path to the directory
     *
     * @throws JsonException → couldn't create directory
     *
     * @return void
     */
    private static function _createDirectory($file) {

        $basename = is_string($file) ? basename($file) : '';

        $path = str_replace($basename, '', $file);

        if (!empty($path) && !is_dir($path)) {

            if (!mkdir($path, 0755, true)) {

                $message = 'Could not create directory in';
            
                throw new JsonException($message . ' ' . $path);
            }
        }
    }

    /**
     * Save file.
     *
     * @since 1.1.3
     *
     * @param string $file → path to the file
     * @param string $json → json string
     *
     * @throws JsonException → couldn't create file
     *
     * @return void
     */
    private static function _saveFile($file, $json) {

        if (@file_put_contents($file, $json) === false) {

            $message = 'Could not create file in';
            
            throw new JsonException($message . ' ' . $file);
        }
    }

    /**
     * Check for errors.
     *
     * @since 1.1.3
     *
     * @return array|null
     */
    private static function _jsonLastError() {

        switch (json_last_error()) {

            case JSON_ERROR_NONE: return null;

            case JSON_ERROR_DEPTH:
                return [
                    'message'    => 'Maximum stack depth exceeded',
                    'error-code' => 1
                ];
            case JSON_ERROR_STATE_MISMATCH:
                return [
                    'message'    => 'Underflow or the modes mismatch',
                    'error-code' => 2
                ];
            case JSON_ERROR_CTRL_CHAR:
                return [
                    'message'    => 'Unexpected control char found',
                    'error-code' => 3
                ];
            case JSON_ERROR_SYNTAX:
                return [
                    'message'    => 'Syntax error, malformed JSON',
                    'error-code' => 4
                ];
            case JSON_ERROR_UTF8:
                return [
                    'message'    => 'Malformed UTF-8 characters',
                    'error-code' => 5
                ];
            case JSON_ERROR_RECURSION:
                return [
                    'message'    => 'Recursion error in value to be encoded',
                    'error-code' => 6
                ];
            case JSON_ERROR_INF_OR_NAN:
                return [
                    'message'    => 'Error NAN/INF in value to be encoded',
                    'error-code' => 7
                ];
            case JSON_ERROR_UNSUPPORTED_TYPE:
                return [
                    'message'    => 'Type value given cannot be encoded',
                    'error-code' => 8
                ];
            case 9: // JSON_ERROR_INVALID_PROPERTY_NAME (PHP 7.0.0)
                return [
                    'message'    => 'Name value given cannot be encoded',
                    'error-code' => 9
                ];
            case 10: //JSON_ERROR_UTF16 (PHP 7.0.0)
                return [
                    'message'    => 'Malformed UTF-16 characters',
                    'error-code' => 10
                ];
            default:
                return [
                    'message'    => 'Unknown error',
                    'error-code' => 999
                ];
        }
    }
}
