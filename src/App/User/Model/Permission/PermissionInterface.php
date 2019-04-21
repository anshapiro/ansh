<?php

namespace App\User\Model\Permission;

use App\User\Model\Permission\Embedded\PermissionNameInterface;

interface PermissionInterface
{
    public const ALIAS = 'permission';

    public const CREATE_USER_PERMISSION = 'u_m_0';
    public const VIEW_USER_PERMISSION = 'u_m_1';
    public const EDIT_USER_PERMISSION = 'u_m_2';

    public const PERMISSIONS = [
        self::CREATE_USER_PERMISSION,
        self::VIEW_USER_PERMISSION,
        self::EDIT_USER_PERMISSION,
    ];

    public function getId();

    public function setId($id): PermissionInterface;

    public function getName(): PermissionNameInterface;

    public function setName(PermissionNameInterface $name): PermissionInterface;
}
