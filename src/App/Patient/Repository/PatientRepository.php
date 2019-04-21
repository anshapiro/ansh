<?php

namespace App\Patient\Repository;

use App\Patient\Model\Patient\Patient;
use Doctrine\ORM\EntityManagerInterface;
use App\Patient\Model\Patient\PatientInterface;
use App\Patient\Model\Patient\PatientRepositoryInterface;

final class PatientRepository implements PatientRepositoryInterface
{
    /** @var EntityManagerInterface */
    private $em;

    /**
     * PatientRepository constructor.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param $id
     *
     * @return null|PatientInterface
     */
    public function find($id): ?PatientInterface
    {
        return $this->em->getRepository(Patient::class)->find($id);
    }

    /**
     * @param array $criteria
     *
     * @return null|PatientInterface
     */
    public function findOneBy(array $criteria): ?PatientInterface
    {
        return $this->em->getRepository(Patient::class)->findOneBy($criteria);
    }

    /**
     * @param array $criteria
     *
     * @return array
     */
    public function findBy(array $criteria): array
    {
        return $this->em->getRepository(Patient::class)->findBy($criteria);
    }

    /**
     * @param $regionId
     *
     * @return int
     */
    public function countTheNumberByRegionId($regionId): int
    {
        return $this->em->createQueryBuilder()
            ->select('COUNT(' . Patient::ALIAS . '.id)')
            ->from(Patient::class, Patient::ALIAS)
            ->where(Patient::ALIAS . '.regionId = :regionId')
            ->setParameter('regionId', $regionId)
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * @param $regionId
     * @param int|null $limit
     * @param int|null $page
     *
     * @return array
     */
    public function getClientListDataByRegionId(
        $regionId,
        ?int $limit = self::DEFAULT_LIMIT,
        ?int $page = self::DEFAULT_PAGE
    ): array {
        return $this->em->createQueryBuilder()
            ->select([
                Patient::ALIAS . '.id',
                $this->concat([
                    Patient::ALIAS . '.fullName.surname',
                    Patient::ALIAS . '.fullName.name',
                    Patient::ALIAS . '.fullName.patronymic',
                ], ', \' \' ,') . ' as fullName',
            ])
            ->from(Patient::class, Patient::ALIAS)
            ->where(Patient::ALIAS . '.regionId = :regionId')
            ->setParameter('regionId', $regionId)
            ->setMaxResults($limit)
            ->setFirstResult(($page - 1) * $limit)
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param array $data
     * @param string $glue
     *
     * @return string
     */
    private function concat(array $data, string $glue): string
    {
        return 'CONCAT(' . implode($glue, $data) . ')';
    }
}
