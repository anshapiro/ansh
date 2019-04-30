<?php

namespace Base\Model;

interface BaseUserInterface
{
    public function hasCreateUserAccess(): bool;

    public function hasViewUserAccess(): bool;

    public function hasEditUserAccess(): bool;

    public function hasPermission(string $permission);
}
