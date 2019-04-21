<?php

namespace App\Patient\Repository;

use App\Patient\Model\Status\Status;
use Doctrine\ORM\EntityManagerInterface;
use App\Patient\Model\Status\StatusInterface;
use App\Patient\Model\Status\StatusRepositoryInterface;

final class StatusRepository implements StatusRepositoryInterface
{
    /** @var EntityManagerInterface */
    private $em;

    /**
     * StatusRepository constructor.
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
     * @return null|StatusInterface
     */
    public function find($id): ?StatusInterface
    {
        return $this->em->getRepository(Status::class)->find($id);
    }

    /**
     * @param array $criteria
     *
     * @return null|StatusInterface
     */
    public function findOneBy(array $criteria): ?StatusInterface
    {
        return $this->em->getRepository(Status::class)->findOneBy($criteria);
    }

    /**
     * @param array $criteria
     *
     * @return array
     */
    public function findBy(array $criteria): array
    {
        return $this->em->getRepository(Status::class)->findBy($criteria);
    }

    /**
     * @param string $name
     *
     * @return null|string
     */
    public function getIdByName(string $name): ?string
    {
        return $this->em->createQueryBuilder()
            ->select(Status::ALIAS . '.id')
            ->from(Status::class, Status::ALIAS)
            ->where('LOWER(' . Status::ALIAS . '.name) = LOWER(:status_name)')
            ->setParameter('status_name', $name)
            ->getQuery()
            ->getSingleScalarResult();
    }
}
