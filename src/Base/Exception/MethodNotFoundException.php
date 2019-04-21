<?php

namespace Base\Exception;

final class MethodNotFoundException extends BaseException
{
    public function __construct(
        string $message = 'Method not found',
        array $placeholders = [],
        int $code = 404,
        \Throwable $previous = null
    ) {
        parent::__construct($message, $placeholders, $code, $previous);
    }
}