<?php

namespace App\User\DataFixtures;

use Help\Api;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\User\Action\User\UserActionInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\User\Model\Permission\PermissionInterface;

final class UserFixture extends Fixture
{
    /** @var UserActionInterface */
    private $createUserAction;

    /**
     * UserFixture constructor.
     *
     * @param UserActionInterface $action
     */
    public function __construct(UserActionInterface $action)
    {
        $this->createUserAction = $action;
    }

    /** @param ObjectManager $manager */
    public function load(ObjectManager $manager): void
    {
        $this
            ->createUser(Api::$viewer, [PermissionInterface::VIEW_USER_PERMISSION], Api::$testRegionOne['id'])
            ->createUser(Api::$editor, [PermissionInterface::EDIT_USER_PERMISSION], Api::$testRegionTwo['id']);

        $manager->flush();
    }

    /**
     * @param array $userData
     * @param array $permissions
     * @param string $regionId
     *
     * @return UserFixture
     */
    private function createUser(array $userData, array $permissions, string $regionId): self
    {
        $userData['permissions'] = $permissions;
        $userData['region_id'] = $regionId;

        $this->createUserAction->perform($userData);

        return $this;
    }
}
