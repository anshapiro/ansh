<?php

namespace App\Region\DataFixtures;

use Help\Api;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Region\Action\Region\RegionActionInterface;

final class RegionFixture extends Fixture
{
    /** @var RegionActionInterface */
    private $createRegionAction;

    /**
     * RegionFixture constructor.
     *
     * @param RegionActionInterface $action
     */
    public function __construct(RegionActionInterface $action)
    {
        $this->createRegionAction = $action;
    }

    /** @param ObjectManager $manager */
    public function load(ObjectManager $manager)
    {
        $this->createRegionAction->perform(Api::$testRegionOne);
        $this->createRegionAction->perform(Api::$testRegionTwo);

        $manager->flush();
    }
}
