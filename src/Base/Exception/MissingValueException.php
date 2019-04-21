<?php

namespace Base\Exception;

final class MissingValueException extends BaseException
{
    public function __construct(
        string $message = 'Missing required value',
        array $placeholders = [],
        int $code = 400,
        \Throwable $previous = null
    ) {
        parent::__construct($message, $placeholders, $code, $previous);
    }
}
