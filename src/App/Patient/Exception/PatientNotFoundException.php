<?php

namespace App\Patient\Exception;

use Base\Exception\BaseException;

final class PatientNotFoundException extends BaseException
{
    public function __construct(
        string $message = 'Patient not found',
        array $placeholders = [],
        int $code = 404,
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $placeholders, $code, $previous);
    }
}
