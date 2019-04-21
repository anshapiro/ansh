<?php

namespace App\Patient\DataFixtures;

use Help\Api;
use App\Region\DataFixtures\RegionFixture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Patient\Action\Patient\PatientActionInterface;
use App\Patient\Model\Region\RegionRepositoryInterface;
use App\Patient\Model\Status\StatusRepositoryInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

final class PatientFixture extends Fixture implements DependentFixtureInterface
{
    /** @var PatientActionInterface */
    private $createPatientAction;

    /** @var RegionRepositoryInterface */
    private $regionRepository;

    /** @var StatusRepositoryInterface */
    private $statusRepository;

    /**
     * PatientFixture constructor.
     *
     * @param PatientActionInterface $action
     * @param RegionRepositoryInterface $regionRepository
     * @param StatusRepositoryInterface $statusRepository
     */
    public function __construct(
        PatientActionInterface $action,
        RegionRepositoryInterface $regionRepository,
        StatusRepositoryInterface $statusRepository
    ) {
        $this->createPatientAction = $action;
        $this->regionRepository = $regionRepository;
        $this->statusRepository = $statusRepository;
    }

    /** @param ObjectManager $manager */
    public function load(ObjectManager $manager): void
    {
        $regionsIds = $this->regionRepository->getIds();

        foreach (Api::$clients as $key => $client) {
            $client['region_id'] = $regionsIds[array_rand($regionsIds, 1)]['id'];
            $client['status'] = $this->statusRepository->getIdByName($client['status']);

            $this->createPatientAction->perform($client);
        }

        $manager->flush();
    }

    /** @return array */
    public function getDependencies(): array
    {
        return [
            RegionFixture::class,
        ];
    }
}
