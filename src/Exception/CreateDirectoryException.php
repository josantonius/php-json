<?php

declare(strict_types=1);

/**
 * PHP simple library for managing JSON files.
 *
 * @author    Josantonius <hello@josantonius.dev>
 * @copyright 2016 (c) Josantonius
 * @license   https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @link      https://github.com/josantonius/php-json
 * @since     2.0.0
 */
namespace Josantonius\Json\Exception;

/**
 * You can use an exception and error handler with this library.
 *
 * @link https://github.com/josantonius/php-errorhandler
 */
class CreateDirectoryException extends \Exception
{
    public function __construct(string $path, \Throwable $th = null)
    {
        $lastError =  error_get_last()['message'] ?? '';

        $message  = "Could not create directory in '$path'.";
        $message .= $lastError ? " $lastError." : '';

        parent::__construct($th ? $th->getMessage() : $message, 0, $th);
    }
}
