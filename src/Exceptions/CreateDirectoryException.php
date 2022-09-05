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

class CreateDirectoryException extends \Exception
{
    public function __construct(string $path)
    {
        $lastError =  error_get_last()['message'] ?? '';

        $message  = "Could not create directory in '$path'.";
        $message .= $lastError ? " $lastError." : '';

        parent::__construct($message);
    }
}
