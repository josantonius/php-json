<?php
/**
 * PHP simple library for managing Json files.
 *
 * @author    Josantonius <hello@josantonius.com>
 * @copyright 2016 - 2017 (c) Josantonius - PHP-Json
 * @license   https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @link      https://github.com/Josantonius/PHP-Json
 * @since     1.0.0
 */
namespace Josantonius\Json;

use Josantonius\Json\Exception\JsonException;
use Josantonius\Json\Exception\JsonLastErrorException;

/**
 * Json handler.
 *
 * @since 1.0.0
 */
class Json
{
    /**
     * Creating JSON file from array.
     *
     * @since 1.0.0
     *
     * @param array  $array → array to be converted to JSON
     * @param string $file  → path to the file
     *
     * @return bool → true if the file is created without errors
     */
    public static function arrayToFile($array, $file)
    {
        self::createDirectory($file);

        $json = json_encode($array, JSON_PRETTY_PRINT);

        $json = self::jsonLastError() ? json_encode($json, 128) : $json;

        self::saveFile($file, $json);

        return ! isset($json['error-code']);
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
    public static function fileToArray($file)
    {
        if (! is_file($file) && ! filter_var($file, FILTER_VALIDATE_URL)) {
            self::arrayToFile([], $file);
        }

        $jsonString = @file_get_contents($file);
        $array = json_decode($jsonString, true);
        $error = self::jsonLastError();

        return $array === null || isset($error['error-code']) ? false : $array;
    }

    /**
     * Create directory recursively if it doesn't exist.
     *
     * @since 1.1.3
     *
     * @param string $file → path to the directory
     *
     * @throws JsonException → couldn't create directory
     */
    private static function createDirectory($file)
    {
        $basename = is_string($file) ? basename($file) : '';
        $path = str_replace($basename, '', $file);

        if (! empty($path) && ! is_dir($path)) {
            if (! mkdir($path, 0755, true)) {
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
     */
    private static function saveFile($file, $json)
    {
        if (@file_put_contents($file, $json) === false) {
            $message = 'Could not create file in';
            throw new JsonException($message . ' ' . $file);
        }
    }

    /**
     * The JSON last error collections.
     *
     * @since 1.1.3
     *
     * @return array
     */
    private static function jsonLastErrorCollections()
    {
        $collections = [
            JSON_ERROR_NONE => null,
            JSON_ERROR_DEPTH => [
                'message' => 'Maximum stack depth exceeded',
                'error-code' => 1,
            ],
            JSON_ERROR_STATE_MISMATCH => [
                'message' => 'Underflow or the modes mismatch',
                'error-code' => 2,
            ],
            JSON_ERROR_CTRL_CHAR => [
                'message' => 'Unexpected control char found',
                'error-code' => 3,
            ],
            JSON_ERROR_SYNTAX => [
                'message' => 'Syntax error, malformed JSON',
                'error-code' => 4,
            ],
            JSON_ERROR_UTF8 => [
                'message' => 'Malformed UTF-8 characters',
                'error-code' => 5,
            ],
            JSON_ERROR_RECURSION => [
                'message' => 'Recursion error in value to be encoded',
                'error-code' => 6,
            ],
            JSON_ERROR_INF_OR_NAN => [
                'message' => 'Error NAN/INF in value to be encoded',
                'error-code' => 7,
            ],
            JSON_ERROR_UNSUPPORTED_TYPE => [
                'message' => 'Type value given cannot be encoded',
                'error-code' => 8,
            ],
            'default' => [
                'message' => 'Unknown error',
                'error-code' => 999,
            ],
        ];

        if (version_compare(PHP_VERSION, '7.0.0', '>='))
        {
            $collections[JSON_ERROR_INVALID_PROPERTY_NAME] = [
                'message' => 'Name value given cannot be encoded',
                'error-code' => 9,
            ];
            $collections[JSON_ERROR_UTF16] = [
                'message' => 'Malformed UTF-16 characters',
                'error-code' => 10,
            ];
        }

        return $collections;
    }

    /**
     * Check for errors.
     *
     * @since 1.1.3
     *
     * @return array|null
     */
    private static function jsonLastError()
    {
        $collections = self::jsonLastErrorCollections();
        $jsonLastError = json_last_error();

        return isset($jsonLastError) ? $collections[$jsonLastError] : $collections['default'];
    }
}
