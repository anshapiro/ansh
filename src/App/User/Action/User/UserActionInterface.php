<?php

namespace App\User\Action\User;

use App\User\Model\User\User;
use App\User\Model\User\UserInterface;

interface UserActionInterface
{
    public const OBJECT_CLASS = User::class;

    public function perform(array $data, ?UserInterface $user = null): UserInterface;
}
