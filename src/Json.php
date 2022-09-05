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
use Josantonius\Json\Exceptions\CreateDirectoryException;
use Josantonius\Json\Exceptions\UnavailableMethodException;

/**
 * PHP simple library for managing JSON files.
 */
class Json
{
    private bool $isUrl;

    /**
     * Create new instance.
     */
    public function __construct(private string $filepath)
    {
        $this->isUrl = filter_var($filepath, FILTER_VALIDATE_URL) !== false;
    }

    /**
     * Check whether a local or remote file exists.
     */
    public function exists(): bool
    {
        $filepath = $this->filepath;

        return $this->isUrl ? @file_get_contents($filepath) !== false : file_exists($filepath);
    }

    /**
     * Get the path or URL of the JSON file.
     */
    public function filepath(): string
    {
        return $this->filepath;
    }

    /**
     * Get the content of the JSON file or a remote JSON file.
     *
     * @throws GetFileException   if the file cannot be read.
     * @throws JsonErrorException if the JSON has errors.
     */
    public function get(): array
    {
        return $this->getFileContents();
    }

    /**
     * Set the content of the JSON file.
     *
     * @throws CreateFileException        if the file cannot be created.
     * @throws UnavailableMethodException if an unavailable method is accessed.
     * @throws CreateDirectoryException   if the directory cannot be created.
     */
    public function set(array|object $content = []): void
    {
        $this->isUrl ? $this->throwUnavailableMethodException() : $this->saveToJsonFile($content);
    }

    /**
     * Merge into JSON file.
     *
     * @throws GetFileException           if the file cannot be read.
     * @throws JsonErrorException         if the JSON has errors.
     * @throws UnavailableMethodException if an unavailable method is accessed.
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
     * @throws GetFileException           if the file cannot be read.
     * @throws JsonErrorException         if the JSON has errors.
     * @throws UnavailableMethodException if an unavailable method is accessed.
     */
    public function push(array|object $content): array
    {
        $data = $this->getFileContents();

        array_push($data, $content);

        $this->isUrl ? $this->throwUnavailableMethodException() : $this->saveToJsonFile($data);

        return $data;
    }

    /**
     * Create directory if not exists.
     *
     * @throws CreateDirectoryException if the directory cannot be created.
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
     * @throws GetFileException         if the file cannot be read.
     * @throws JsonErrorException       if the JSON has errors.
     * @throws CreateDirectoryException if the directory cannot be created.
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
     * @throws CreateFileException if the file cannot be created.
     */
    private function saveToJsonFile(array|object $array): void
    {
        $json = json_encode($array, JSON_PRETTY_PRINT);

        $this->createDirIfNotExists();

        if (@file_put_contents($this->filepath, $json) === false) {
            throw new CreateFileException($this->filepath);
        }
    }

    /**
     * Check for JSON errors.
     *
     * @throws JsonErrorException if the JSON has errors.
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
     * @throws UnavailableMethodException if an unavailable method is accessed.
     */
    private function throwUnavailableMethodException(): void
    {
        $method = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1]['function'];

        throw new UnavailableMethodException($method);
    }
}
