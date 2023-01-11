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

namespace Josantonius\Json;

use Josantonius\Json\Exceptions\GetFileException;
use Josantonius\Json\Exceptions\JsonErrorException;
use Josantonius\Json\Exceptions\CreateFileException;
use Josantonius\Json\Exceptions\NoIterableFileException;
use Josantonius\Json\Exceptions\CreateDirectoryException;
use Josantonius\Json\Exceptions\NoIterableElementException;

/**
 * PHP simple library for managing JSON files.
 */
class Json
{
    /**
     * Constructor method for the JSON file handling class.
     *
     * @param string $filepath The path to the JSON file to be handled.
     */
    public function __construct(public readonly string $filepath)
    {
    }

    /**
     * Check if the file exists.
     *
     * @return bool True if the file exists at the specified filepath, false otherwise.
     */
    public function exists(): bool
    {
        return file_exists($this->filepath);
    }

    /**
     * Get the contents of the JSON file.
     *
     * @param bool $asObject If true and the value is an array, it is returned as an object.
     *
     * @throws GetFileException   if file reading failed.
     * @throws JsonErrorException if the file contains invalid JSON.
     *
     * @return mixed the contents of the JSON file.
     */
    public function get(bool $asObject = false): mixed
    {
        $json = @file_get_contents($this->filepath);

        $json === false && throw new GetFileException($this->filepath);

        $array = json_decode($json, !$asObject);

        json_last_error() && throw new JsonErrorException();

        return $array;
    }

    /**
     * Set the contents of a JSON or a key within the file.
     *
     * @param mixed  $content The data that will be written to the file or a key within the file.
     * @param string $dot     The dot notation representing the key to be modified within the file.
     *
     * @throws GetFileException           if file reading failed.
     * @throws JsonErrorException         if the file contains invalid JSON.
     * @throws CreateFileException        if file creation failed.
     * @throws CreateDirectoryException   if directory creation failed.
     * @throws NoIterableElementException if $dot isn't an array location.
     *
     * @return mixed the content of the JSON file after the set operation.
     */
    public function set(mixed $content = [], string $dot = null): array|bool|int|null|string
    {
        $data = $dot !== null ? $this->get() : $content;

        if ($dot !== null) {
            $this->failIfNotArray(__FUNCTION__, $data, $dot);
            $this->modifyArrayByDot(__FUNCTION__, $data, $dot, $content);
        }

        return $this->saveToJsonFile($data);
    }

    /**
     * Merge the provided data with the contents of a JSON file or a key within the file.
     *
     * @param mixed  $content The data that will be written to the file or a key within the file.
     * @param string $dot     The dot notation representing the key to be modified within the file.
     *
     * @throws GetFileException           if file reading failed.
     * @throws JsonErrorException         if the file contains invalid JSON.
     * @throws NoIterableFileException    if the file isn't a JSON array.
     * @throws NoIterableElementException if $dot isn't an array location.
     *
     * @return mixed the content of the JSON file after the merge operation.
     */
    public function merge(array|object $content, string $dot = null): array
    {
        $data = $this->get();

        $this->failIfNotArray(__FUNCTION__, $data, $this->filepath);

        if ($dot !== null) {
            $this->modifyArrayByDot(__FUNCTION__, $data, $dot, $content);
            return $this->saveToJsonFile($data);
        }

        return $this->saveToJsonFile(array_merge($data, (array) $content));
    }

    /**
     * Remove and get the last element of a JSON file or a key within the file.
     *
     * @param string $dot The dot notation representing the key to be modified within the file.
     *
     * @throws GetFileException           if file reading failed.
     * @throws JsonErrorException         if the file contains invalid JSON.
     * @throws NoIterableFileException    if the file isn't a JSON array.
     * @throws NoIterableElementException if $dot isn't an array location.
     *
     * @return mixed|null the last value of JSON file, or null if array is empty.
     */
    public function pop(string $dot = null): mixed
    {
        $data = $this->get();

        if ($dot !== null) {
            $value = $this->modifyArrayByDot(__FUNCTION__, $data, $dot);
            $this->saveToJsonFile($data);
            return $value;
        }

        $this->failIfNotArray(__FUNCTION__, $data, $this->filepath);
        $value = array_pop($data);
        $this->saveToJsonFile($data);
        return $value;
    }

    /**
     * Add the provided data to the end of the contents of a JSON file or a key within the file.
     *
     * @param mixed  $content The data that will be written to the file or a key within the file.
     * @param string $dot     The dot notation representing the key to be modified within the file.
     *
     * @throws GetFileException           if file reading failed.
     * @throws JsonErrorException         if the file contains invalid JSON.
     * @throws NoIterableFileException    if the file isn't a JSON array.
     * @throws NoIterableElementException if $dot isn't an array location.
     *
     * @return mixed the content of the JSON file after the push operation.
     */
    public function push(mixed $content, string $dot = null): array
    {
        $data = $this->get();

        $this->failIfNotArray(__FUNCTION__, $data, $this->filepath);

        if ($dot !== null) {
            $this->modifyArrayByDot(__FUNCTION__, $data, $dot, $content);
            return $this->saveToJsonFile($data);
        }
        array_push($data, $content);

        return $this->saveToJsonFile($data);
    }

    /**
     * Remove and get the first element of a JSON file or a key within the file.
     *
     * @param string $dot The dot notation representing the key to be modified within the file.
     *
     * @throws GetFileException           if file reading failed.
     * @throws JsonErrorException         if the file contains invalid JSON.
     * @throws NoIterableFileException    if the file isn't a JSON array.
     * @throws NoIterableElementException if $dot isn't an array location.
     *
     * @return mixed|null the shifted value, or null if array is empty.
     */
    public function shift(string $dot = null): mixed
    {
        $data = $this->get();

        if ($dot !== null) {
            $value = $this->modifyArrayByDot(__FUNCTION__, $data, $dot);
            $this->saveToJsonFile($data);
            return $value;
        }

        $this->failIfNotArray(__FUNCTION__, $data, $this->filepath);
        $value = array_shift($data);
        $this->saveToJsonFile($data);
        return $value;
    }

    /**
     * Remove a key and its value from the contents of a JSON file.
     *
     * @param string $dot       The dot notation representing the key to be modified within the file.
     * @param bool   $reindexed If true, the array will be re-indexed.
     *
     * @throws GetFileException         if file reading failed.
     * @throws JsonErrorException       if the file contains invalid JSON.
     * @throws NoIterableFileException  if the file isn't a JSON array.
     *
     * @return array the content of the JSON file after the unset operation.
     */
    public function unset(string $dot, bool $reindexed = false): array
    {
        $data = $this->get();

        $this->failIfNotArray(__FUNCTION__, $data, $this->filepath);
        $this->modifyArrayByDot(__FUNCTION__, $data, $dot);

        return $this->saveToJsonFile($reindexed ? array_values($data) : $data);
    }

    /**
     * Add the provided data to the beginning of the contents of a JSON file or a key within the file.
     *
     * @param mixed  $content The data that will be written to the file or a key within the file.
     * @param string $dot     The dot notation representing the key to be modified within the file.
     *
     * @throws GetFileException           if file reading failed.
     * @throws JsonErrorException         if the file contains invalid JSON.
     * @throws NoIterableFileException    if the file isn't a JSON array.
     * @throws NoIterableElementException if $dot isn't an array location.
     *
     * @return mixed the content of the JSON file after the unshift operation.
     */
    public function unshift(mixed $content, string $dot = null): mixed
    {
        $data = $this->get();

        $this->failIfNotArray(__FUNCTION__, $data, $this->filepath);

        if ($dot !== null) {
            $this->modifyArrayByDot(__FUNCTION__, $data, $dot, $content);
            return $this->saveToJsonFile($data);
        }
        array_unshift($data, $content);

        return $this->saveToJsonFile($data);
    }

    /**
     * Modify a nested array key by a dot notation string.
     *
     * @param string $type    The type of operation to perform on the array.
     * @param mixed  $array   The array that will be modified.
     * @param mixed  $dot     The dot notation string representing the key of the nested array.
     * @param mixed  $content The value that will be set or pushed to the array.
     *
     * @throws NoIterableElementException if $dot isn't an array location.
     *
     * @return mixed the contents that have been written to the file after the unshift operation.
     */
    protected function modifyArrayByDot(string $type, array &$array, string $dot, mixed $content = []): mixed
    {
        $keys = explode('.', $dot);

        if ($type == 'unset') {
            $last = array_pop($keys);
        }

        foreach ($keys as $key) {
            $array = &$array[$key];
        }

        if (!str_contains($type, 'set')) {
            $this->failIfNotArray($type, $array, $dot);
        }

        switch ($type) {
            case 'merge':
                $array = array_merge($array, (array) $content);
                break;
            case 'pop':
                return array_pop($array);
            case 'push':
                return array_push($array, is_object($content) ? (array) $content : $content);
            case 'set':
                $array = $content;
                break;
            case 'shift':
                return array_shift($array);
            case 'unset':
                unset($array[$last]);
                break;
            case 'unshift':
                return array_unshift($array, is_object($content) ? (array) $content : $content);
        }

        return null;
    }

    /**
     * Save contents to JSON file.
     *
     * @param mixed $content The data to be encoded as JSON and saved to the file.
     *
     * @throws CreateFileException      if directory creation failed.
     * @throws CreateDirectoryException if file creation failed.
     *
     * @return mixed the contents that have been saved to the file.
     */
    protected function saveToJsonFile(mixed $content): mixed
    {
        $json = json_encode($content, JSON_PRETTY_PRINT);
        $path = dirname($this->filepath) . DIRECTORY_SEPARATOR;

        if (!is_dir($path) && !@mkdir($path, 0777, true)) {
            throw new CreateDirectoryException($path);
        }

        if (@file_put_contents($this->filepath, $json) === false) {
            throw new CreateFileException($this->filepath);
        }

        return is_object($content) ? (array) $content : $content;
    }

    /**
     * Throws an exception if the element is not an array.
     *
     * @param string $type  The operation type.
     * @param mixed  $data  The array to check.
     * @param string $param The dot notation or filepath.
     *
     * @throws NoIterableFileException    if the file isn't a JSON array.
     * @throws NoIterableElementException if $dot isn't an array location.
     */
    protected function failIfNotArray(string $type, mixed $data, string $param): void
    {
        if (is_array($data)) {
            return;
        }

        if (file_exists($param)) {
            throw new NoIterableFileException($param, $type);
        }

        throw new NoIterableElementException($param, $type);
    }
}
