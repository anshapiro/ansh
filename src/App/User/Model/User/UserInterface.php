<?php

namespace App\User\Model\User;

use App\User\Model\Permission\PermissionInterface;
use App\User\Model\User\Embedded\UserFullNameInterface;

interface UserInterface extends UserPermissionsInterface
{
    public const ALIAS = 'user';

    public const DEFAULT_PASSWORD = 123;

    public function getId();

    public function setId($id): UserInterface;

    public function getUsername(): string;

    public function setUsername(string $username): UserInterface;

    public function getEmail(): string;

    public function setEmail(string $email): UserInterface;

    public function getPassword(): string;

    public function setPassword(string $password): UserInterface;

    public function getFullName(): UserFullNameInterface;

    public function setFullName(UserFullNameInterface $fullName): UserInterface;

    public function getPermissions();

    public function setPermissions(array $permissions): UserInterface;

    public function addPermission(PermissionInterface $permission): UserInterface;

    public function removePermission(PermissionInterface $permission): UserInterface;

    public function getRegionId();

    public function setRegionId($regionId): UserInterface;
}
