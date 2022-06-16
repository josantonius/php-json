<?php

declare(strict_types=1);

/**
 * PHP simple library for managing JSON files.
 *
 * @author    Josantonius <hello@josantonius.dev>
 * @copyright 2016 (c) Josantonius
 * @license   https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @link      https://github.com/josantonius/php-json
 * @since     1.0.0
 */

namespace Josantonius\Json;

use Josantonius\Json\Exception\CreateDirectoryException;
use Josantonius\Json\Exception\CreateFileException;
use Josantonius\Json\Exception\GetFileException;
use Josantonius\Json\Exception\JsonErrorException;
use Josantonius\Json\Exception\UnavailableMethodException;

class Json
{
    /**
     * If the file path is a URL.
     *
     * @since 2.0.0
     */
    private bool $isUrl;

    /**
     * @since 2.0.0
     *
     * @throws CreateDirectoryException
     * @throws CreateFileException
     * @throws JsonErrorException
     */
    public function __construct(private string $filepath)
    {
        $this->isUrl = filter_var($filepath, FILTER_VALIDATE_URL) !== false;

        if (!$this->isUrl) {
            $this->createFileIfNotExists($filepath);
        }
    }

    /**
     * Get the content of the JSON file or a remote JSON file.
     *
     * @since 2.0.0
     *
     * @throws GetFileException
     * @throws JsonErrorException
     */
    public function get(): array
    {
        return $this->getFileContents();
    }

    /**
     * Set the content of the JSON file.
     *
     * @since 2.0.0
     *
     * @throws CreateFileException
     * @throws JsonErrorException
     * @throws UnavailableMethodException
     */
    public function set(array|object $content): void
    {
        $this->isUrl ? $this->throwUnavailableMethodException() : $this->saveToJsonFile($content);
    }

    /**
     * Merge into JSON file.
     *
     * @since 2.0.0
     *
     * @throws CreateFileException
     * @throws GetFileException
     * @throws JsonErrorException
     * @throws UnavailableMethodException
     */
    public function merge(array|object $content): array
    {
        $content = array_merge($this->getFileContents(), (array) $content);

        $this->isUrl ? $this->throwUnavailableMethodException() : $this->saveToJsonFile($content);

        return $content;
    }

    /**
     * Push on the JSON file.
     *
     * @since 2.0.0
     *
     * @throws CreateFileException
     * @throws GetFileException
     * @throws JsonErrorException
     * @throws UnavailableMethodException
     */
    public function push(array|object $content): array
    {
        $data = $this->getFileContents();

        array_push($data, $content);

        $this->isUrl ? $this->throwUnavailableMethodException() : $this->saveToJsonFile($data);

        return $data;
    }

    /**
     * Create JSON file from array.
     *
     * @deprecated
     *
     * @throws CreateFileException
     * @throws JsonErrorException
     * @throws UnavailableMethodException
     */
    public static function arrayToFile(array|object $array, string $file): bool
    {
        $message = 'The "arrayToFile" method is deprecated and will be removed. Use "set" instead.';
        $url     = 'More information at: https://github.com/josantonius/php-json.';
        trigger_error($message . ' ' . $url, E_USER_DEPRECATED);

        (new Json($file))->set($array);

        return true;
    }

    /**
     * Get the content of the JSON file or a remote JSON file.
     *
     * @deprecated
     *
     * @throws GetFileException
     * @throws JsonErrorException
     */
    public static function fileToArray($file): array
    {
        $message = 'The "fileToArray" method is deprecated and will be removed. Use "get" instead.';
        $url     = 'More information at: https://github.com/josantonius/php-json.';
        trigger_error($message . ' ' . $url, E_USER_DEPRECATED);

        return (new Json($file))->get();
    }

    /**
     * Create file if not exists.
     *
     * @since 2.0.0
     *
     * @throws CreateDirectoryException
     * @throws CreateFileException
     * @throws JsonErrorException
     */
    private function createFileIfNotExists(): void
    {
        if (!file_exists($this->filepath)) {
            $this->createDirIfNotExists();
            $this->saveToJsonFile([]);
        }
    }

    /**
     * Create directory if not exists.
     *
     * @since 2.0.0
     *
     * @throws CreateDirectoryException
     */
    private function createDirIfNotExists(): void
    {
        $path = dirname($this->filepath) . DIRECTORY_SEPARATOR;

        if (!is_dir($path) && !@mkdir($path, 0777, true)) {
            throw new CreateDirectoryException($path);
        }
    }

    /**
     * Get the content of the JSON file or a remote JSON file.
     *
     * @since 2.0.0
     *
     * @throws GetFileException
     * @throws JsonErrorException
     */
    private function getFileContents(): array
    {
        $json = @file_get_contents($this->filepath);

        if ($json === false) {
            throw new GetFileException($this->filepath);
        }

        $array = json_decode($json, true);

        $this->checkJsonLastError();

        return $array;
    }

    /**
     * Save content in JSON file.
     *
     * @since 2.0.0
     *
     * @throws CreateFileException
     * @throws JsonErrorException
     */
    private function saveToJsonFile(array|object $array): void
    {
        $json = json_encode($array, JSON_PRETTY_PRINT);

        $this->checkJsonLastError();

        if (@file_put_contents($this->filepath, $json) === false) {
            throw new CreateFileException($this->filepath);
        }
    }

    /**
     * Check for JSON errors.
     *
     * @since 2.0.0
     *
     * @throws JsonErrorException
     */
    private function checkJsonLastError(): void
    {
        if (json_last_error()) {
            throw new JsonErrorException();
        }
    }

    /**
     * Throw exception if the method is not available for remote JSON files.
     *
     * @since 2.0.0
     *
     * @throws UnavailableMethodException
     */
    private function throwUnavailableMethodException(): void
    {
        $method = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1]['function'];
        
        throw new UnavailableMethodException($method);
    }
}
