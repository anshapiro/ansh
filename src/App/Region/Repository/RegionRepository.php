<?php

namespace App\Region\Repository;

use App\Region\Model\Region\Region;
use Doctrine\ORM\EntityManagerInterface;
use App\Region\Model\Region\RegionRepositoryInterface;

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
    public function getAllRegionsIds(): array
    {
        return $this->em->createQueryBuilder()
            ->select(Region::ALIAS . '.id')
            ->from(Region::class, Region::ALIAS)
            ->getQuery()
            ->getArrayResult();
    }
}
