<?php

namespace App\User\Model\User;

interface UserRepositoryInterface
{
    public function find($id): ?UserInterface;

    public function findOneBy(array $criteria): ?UserInterface;

    public function findBy(array $criteria): array;
}
