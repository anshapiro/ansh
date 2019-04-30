<?php

namespace App\User\Exception;

use Base\Exception\BaseException;

final class ForbiddenException extends BaseException
{
    /**
     * ForbiddenException constructor.
     *
     * @param string $message
     * @param array $placeholders
     * @param int $code
     * @param null|\Throwable $previous
     */
    public function __construct(
        string $message = 'Forbidden',
        array $placeholders = [],
        int $code = 403,
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $placeholders, $code, $previous);
    }
}
