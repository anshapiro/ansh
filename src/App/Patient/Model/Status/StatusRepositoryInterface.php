<?php

namespace App\Patient\Model\Status;

interface StatusRepositoryInterface
{
    public function find($id): ?StatusInterface;

    public function findOneBy(array $criteria): ?StatusInterface;

    public function findBy(array $criteria): array;

    public function getIdByName(string $name): ?string;
}
