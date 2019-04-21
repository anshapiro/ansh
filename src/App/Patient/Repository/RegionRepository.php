<?php

namespace App\Patient\Repository;

use App\Region\Model\Region\Region;
use App\Region\Model\Region\RegionInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Patient\Model\Region\RegionRepositoryInterface;

final class RegionRepository implements RegionRepositoryInterface
{
    /** @var EntityManagerInterface */
    private $em;

    /**
     * RegionRepository constructor.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /** @return array */
    public function getIds(): array
    {
        return $this->em->createQueryBuilder()
            ->select(Region::ALIAS . '.id')
            ->from(Region::class, Region::ALIAS)
            ->getQuery()
            ->getArrayResult();
    }

    /**
     * @param $id
     *
     * @return RegionInterface|null
     */
    public function find($id): ?RegionInterface
    {
        return $this->em->getRepository(Region::class)->find($id);
    }
}
