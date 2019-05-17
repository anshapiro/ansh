<?php

namespace App\User\Exception;

use Base\Exception\BaseException;

final class UserSessionNotFoundException extends BaseException
{
    /**
     * UserSessionNotFoundException constructor.
     *
     * @param string $message
     * @param array $placeholders
     * @param int $code
     * @param null|\Throwable $previous
     */
    public function __construct(
        string $message = 'User session not found',
        array $placeholders = [],
        int $code = 404,
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $placeholders, $code, $previous);
    }
}
