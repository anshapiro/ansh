<?php

namespace App\Region\Exception;

use Base\Exception\BaseException;

final class RegionNotFoundException extends BaseException
{
    public function __construct(
        string $message = 'Region not found',
        array $placeholders = [],
        int $code = 404,
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $placeholders, $code, $previous);
    }
}
