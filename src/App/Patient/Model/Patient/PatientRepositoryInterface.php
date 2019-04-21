<?php

namespace App\Patient\Model\Patient;

interface PatientRepositoryInterface
{
    public const DEFAULT_LIMIT = 10;

    public const DEFAULT_PAGE = 1;

    public function find($id): ?PatientInterface;

    public function findOneBy(array $criteria): ?PatientInterface;

    public function findBy(array $criteria): array;

    public function countTheNumberByRegionId($regionId): int;

    public function getClientListDataByRegionId(
        $regionId,
        ?int $limit = self::DEFAULT_LIMIT,
        ?int $page = self::DEFAULT_PAGE
    ): array;
}
