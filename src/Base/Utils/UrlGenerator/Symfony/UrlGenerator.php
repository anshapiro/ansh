<?php

namespace Base\Utils\UrlGenerator\Symfony;

use Base\Utils\UrlGenerator\UrlGeneratorInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface as SymfonyUrlGeneratorInterface;

final class UrlGenerator implements UrlGeneratorInterface
{
    /** @var SymfonyUrlGeneratorInterface */
    private $urlGenerator;

    /**
     * UrlGenerator constructor.
     *
     * @param SymfonyUrlGeneratorInterface $urlGenerator
     */
    public function __construct(SymfonyUrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @param string $name
     * @param array $parameters
     *
     * @return string
     */
    public function generate(string $name, array $parameters = []): string
    {
        return $this->urlGenerator->generate($name, $parameters);
    }
}
