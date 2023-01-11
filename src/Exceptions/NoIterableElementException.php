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

class NoIterableElementException extends \Exception
{
    public function __construct(string $dot, string $method)
    {
        parent::__construct(
            "The location specified by '$dot' dot is not an array to perform a '$method' operation on."
        );
    }
}
