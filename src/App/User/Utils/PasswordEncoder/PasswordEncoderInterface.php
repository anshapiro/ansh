<?php

namespace App\User\Utils\PasswordEncoder;

use App\User\Model\User\User;
use App\User\Model\User\UserInterface;

interface PasswordEncoderInterface
{
    public const USER_CLASS = User::class;

    public function encode(string $password);

    public function isValid(UserInterface $user, string $password): bool;
}
