<?php

namespace Base\Security\Voter;

interface UserVoterInterface
{
    public const MANAGE_USER_ACCESS = 'manage-user';
    public const CREATE_USER_ACCESS = 'create-user';
    public const VIEW_USER_ACCESS = 'view-user';
    public const EDIT_USER_ACCESS = 'edit-user';

    public const PERMISSIONS = [
        self::CREATE_USER_ACCESS,
        self::VIEW_USER_ACCESS,
        self::EDIT_USER_ACCESS,
    ];
}
