<?php

namespace App\Patient\Action\Patient\Update;

use Base\Utils\Serializer\SerializerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\Patient\Model\Patient\PatientInterface;
use App\Patient\Exception\PatientNotFoundException;
use App\Patient\Action\Patient\PatientActionInterface;

final class UpdatePatientAction implements PatientActionInterface
{
    /** @var ObjectManager */
    private $om;

    /** @var SerializerInterface */
    private $serializer;

    /**
     * UpdateRegionAction constructor.
     *
     * @param ObjectManager $om
     * @param SerializerInterface $serializer
     */
    public function __construct(ObjectManager $om, SerializerInterface $serializer)
    {
        $this->om = $om;
        $this->serializer = $serializer;
    }

    /**
     * @param array $data
     * @param PatientInterface|null $patient
     *
     * @throws PatientNotFoundException
     *
     * @return PatientInterface
     */
    public function perform(array $data, ?PatientInterface $patient = null): PatientInterface
    {
        if ($patient === null) {
            throw new PatientNotFoundException();
        }

        $patient = $this->serializer->deserialize($data, self::OBJECT_CLASS, [
            'object_to_populate' => $patient,
        ]);
        $this->om->persist($patient);

        return $patient;
    }
}
