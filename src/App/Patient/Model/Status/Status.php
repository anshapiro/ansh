<?php

namespace App\Patient\Model\Status;

use Ramsey\Uuid\Uuid;

class Status implements StatusInterface
{
    /** @var string */
    private $id;

    /** @var string */
    private $name;

    /** Status constructor. */
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
     * @return StatusInterface
     */
    public function setId($id): StatusInterface
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
     * @return StatusInterface
     */
    public function setName(string $name): StatusInterface
    {
        $this->name = $name;

        return $this;
    }
}
