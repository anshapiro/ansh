<?php

namespace App\User\Model\Permission\Embedded;

interface PermissionNameInterface
{
    public function getCategoryName(): string;

    public function setCategoryName(string $categoryName): PermissionNameInterface;

    public function getPermissionName(): string;

    public function setPermissionName(string $permissionName): PermissionNameInterface;

    public function name(): string;
}
