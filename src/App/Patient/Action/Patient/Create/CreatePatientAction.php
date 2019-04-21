<?php

namespace App\Patient\Action\Patient\Create;

use Base\Utils\Serializer\SerializerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\Patient\Model\Patient\PatientInterface;
use App\Patient\Action\Patient\PatientActionInterface;

final class CreatePatientAction implements PatientActionInterface
{
    /** @var ObjectManager */
    private $om;

    /** @var SerializerInterface */
    private $serializer;

    /**
     * CreateRegionAction constructor.
     *
     * @param ObjectManager $om
     * @param SerializerInterface $serializer
     */
    public function __construct(
        ObjectManager $om,
        SerializerInterface $serializer
    ) {
        $this->om = $om;
        $this->serializer = $serializer;
    }

    /**
     * @param array $data
     * @param PatientInterface|null $patient
     *
     * @return PatientInterface
     */
    public function perform(array $data, ?PatientInterface $patient = null): PatientInterface
    {
        $newPatient = $this->serializer->deserialize($data, self::OBJECT_CLASS);
        $this->om->persist($newPatient);

        return $newPatient;
    }
}
