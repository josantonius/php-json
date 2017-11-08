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
namespace Josantonius\Json\Exception;

/**
 * Exception class for Json library.
 *
 * You can use an exception and error handler with this library.
 *
 * @since 1.0.0
 *
 * @link https://github.com/Josantonius/PHP-ErrorHandler
 */
class JsonException extends \Exception
{
    /**
     * Exception handler.
     *
     * @since 1.0.0
     *
     * @param string $msg    → message error (Optional)
     * @param int    $status → HTTP response status code (Optional)
     */
    public function __construct($msg = '', $status = 0)
    {
        $this->message = $msg;
        $this->statusCode = $status;
    }
}
