<?php

/**
 * PHP simple library for managing JSON files.
 *
 * @author    Josantonius <hello@josantonius.dev>
 * @copyright 2016 (c) Josantonius
 * @license   https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @link      https://github.com/josantonius/php-json
 * @since     1.0.0
 */
namespace Josantonius\Json\Exception;

/**
 * Exception class for JSON library.
 *
 * You can use an exception and error handler with this library.
 *
 * @link https://github.com/josantonius/php-errorhandler
 */
class JsonException extends \Exception
{
    /**
     * Exception handler.
     *
     * @param string $msg    → message error (Optional)
     * @param int    $status → HTTP response status code (Optional)
     */
    public function __construct($msg = '', $status = 0)
    {
        $this->message    = $msg;
        $this->statusCode = $status;
    }
}
