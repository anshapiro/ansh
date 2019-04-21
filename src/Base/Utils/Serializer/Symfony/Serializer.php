<?php

namespace Base\Utils\Serializer\Symfony;

use Base\Utils\Serializer\SerializerInterface;
use Symfony\Component\Serializer\SerializerInterface as SymfonySerializerInterface;

final class Serializer implements SerializerInterface
{
    /** @var SymfonySerializerInterface */
    private $serializer;

    /**
     * Serializer constructor.
     *
     * @param SymfonySerializerInterface $serializer
     */
    public function __construct(SymfonySerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param array $data
     * @param string $class
     * @param array $parameters
     *
     * @return object
     */
    public function deserialize(array $data, string $class, array $parameters = [])
    {
        return $this->serializer->deserialize(json_encode($data), $class, 'json', $parameters);
    }
}
