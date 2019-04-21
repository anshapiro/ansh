<?php

namespace App\User\Model\User;

interface UserPermissionsInterface
{
    public function hasCreateUserAccess(): bool;

    public function hasViewUserAccess(): bool;

    public function hasEditUserAccess(): bool;

    public function hasPermission(string $permission);
}
