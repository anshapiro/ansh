<?php

namespace App\Region\Model\Region;

use Ramsey\Uuid\Uuid;

class Region implements RegionInterface
{
    /** @var string */
    private $id;

    /** @var string */
    private $name;

    /** Region constructor. */
    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
    }

    /** @return string */
    public function __toString(): string
    {
        return $this->getId();
    }

    /** @return string */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param $id
     *
     * @return RegionInterface
     */
    public function setId($id): RegionInterface
    {
        $this->id = $id;

        return $this;
    }

    /** @return string */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return RegionInterface
     */
    public function setName(string $name): RegionInterface
    {
        $this->name = $name;

        return $this;
    }
}
