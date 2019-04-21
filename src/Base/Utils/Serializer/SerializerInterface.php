<?php

namespace Base\Utils\Serializer;

interface SerializerInterface
{
    public function deserialize(array $data, string $class, array $parameters = []);
}
