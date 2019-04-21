<?php

namespace Base\Utils\UrlGenerator;

interface UrlGeneratorInterface
{
    public function generate(string $name, array $parameters = []): string;
}
