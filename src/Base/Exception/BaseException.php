<?php

namespace Base\Exception;

class BaseException extends \Exception
{
    protected const PLACEHOLDER = '{{ %s }}';

    /**
     * BaseException constructor.
     *
     * @param string $message
     * @param array $placeholders
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct(
        string $message = 'Internal server error',
        array $placeholders = [],
        int $code = 500,
        \Throwable $previous = null
    ) {
        $this->replacePlaceholders($message, $placeholders);

        parent::__construct($message, $code, $previous);
    }

    /**
     * @param string $placeholder
     *
     * @return string
     */
    public static function createPlaceholder(string $placeholder): string
    {
        return sprintf(self::PLACEHOLDER, $placeholder);
    }

    /**
     * @param string $message
     * @param array $placeholders
     */
    protected function replacePlaceholders(string &$message, array $placeholders): void
    {
        foreach ($placeholders as $placeholderName => $placeholderValue) {
            if (\is_array($placeholderValue)) {
                foreach ($placeholderValue as $key => $value) {
                    $placeholderValue[$key] = sprintf('"%s" => "%s"', $key, $value);
                }

                $placeholderValue = sprintf('(%s)', implode(', ', $placeholderValue));
            }

            $message = str_replace(self::createPlaceholder($placeholderName), $placeholderValue, $message);
        }
    }
}
