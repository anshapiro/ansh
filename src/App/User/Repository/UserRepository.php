<?php

namespace App\User\Repository;

use App\User\Model\User\User;
use App\User\Model\User\UserInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\User\Exception\UserNotFoundException;
use App\User\Model\User\UserRepositoryInterface;

final class UserRepository implements UserRepositoryInterface
{
    /** @var EntityManagerInterface */
    private $em;

    /**
     * UserRepository constructor.
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
     * @return null|UserInterface
     */
    public function find($id): ?UserInterface
    {
        return $this->em->getRepository(User::class)->find($id);
    }

    /**
     * @param array $criteria
     *
     * @return null|UserInterface
     */
    public function findOneBy(array $criteria): ?UserInterface
    {
        return $this->em->getRepository(User::class)->findOneBy($criteria);
    }

    /**
     * @param array $criteria
     *
     * @return array
     */
    public function findBy(array $criteria): array
    {
        return $this->em->getRepository(User::class)->findBy($criteria);
    }
}
