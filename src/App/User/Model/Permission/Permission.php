<?php

namespace App\User\Model\Permission;

use App\User\Model\Permission\Embedded\PermissionNameInterface;

class Permission implements PermissionInterface
{
    #################### CLASS PROPERTIES ####################

    /** @var string */
    private $id;

    /** @var PermissionNameInterface */
    private $name;

    #################### END OF CLASS PROPERTIES ####################

    #################### MAGIC METHODS ####################

    /** @return string */
    public function __toString(): string
    {
        return $this->getId();
    }

    #################### END OF MAGIC METHODS ####################

    #################### PERMISSION INTERFACE ####################

    /** @return string */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param $id
     *
     * @return PermissionInterface
     */
    public function setId($id): PermissionInterface
    {
        $this->id = $id;

        return $this;
    }

    /** @return PermissionNameInterface */
    public function getName(): PermissionNameInterface
    {
        return $this->name;
    }

    /**
     * @param PermissionNameInterface $name
     *
     * @return PermissionInterface
     */
    public function setName(PermissionNameInterface $name): PermissionInterface
    {
        $this->name = $name;

        return $this;
    }

    #################### END OF PERMISSION INTERFACE ####################
}
