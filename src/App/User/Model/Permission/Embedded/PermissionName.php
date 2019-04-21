<?php

namespace App\User\Model\Permission\Embedded;

final class PermissionName implements PermissionNameInterface
{
    #################### CLASS PROPERTIES ####################

    /** @var string */
    private $categoryName;

    /** @var string */
    private $permissionName;

    #################### END OF CLASS PROPERTIES ####################

    #################### MAGIC METHODS ####################

    /** @return string */
    public function __toString(): string
    {
        return $this->name();
    }

    #################### END OF MAGIC METHODS ####################

    #################### PERMISSION NAME INTERFACE ####################

    /** @return string */
    public function getCategoryName(): string
    {
        return $this->categoryName;
    }

    /**
     * @param string $categoryName
     *
     * @return PermissionNameInterface
     */
    public function setCategoryName(string $categoryName): PermissionNameInterface
    {
        $this->categoryName = $categoryName;

        return $this;
    }

    /** @return string */
    public function getPermissionName(): string
    {
        return $this->permissionName;
    }

    /**
     * @param string $permissionName
     *
     * @return PermissionNameInterface
     */
    public function setPermissionName(string $permissionName): PermissionNameInterface
    {
        $this->permissionName = $permissionName;

        return $this;
    }

    /** @return string */
    public function name(): string
    {
        return sprintf('%s: $s', $this->getCategoryName(), $this->getPermissionName());
    }

    #################### END OF PERMISSION NAME INTERFACE ####################
}
