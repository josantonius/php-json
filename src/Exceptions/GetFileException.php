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

namespace Josantonius\Json\Exceptions;

class GetFileException extends \Exception
{
    public function __construct(string $filepath)
    {
        $lastError =  error_get_last()['message'] ?? '';

        $message  = "Error reading file: '$filepath'.";
        $message .= $lastError ? " $lastError." : '';

        parent::__construct($message);
    }
}
