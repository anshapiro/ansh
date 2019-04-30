<?php

namespace App\Patient\Model\Patient;

use App\Patient\Model\Patient\Embedded\PatientAddressInterface;
use Ramsey\Uuid\Uuid;
use App\Patient\Model\Status\StatusInterface;
use App\Patient\Model\Patient\Embedded\PatientFullNameInterface;

class Patient implements PatientInterface
{
    /** @var string */
    private $id;

    /** @var PatientFullNameInterface */
    private $fullName;

    /** @var string */
    private $regionId;
    
    /** @var \DateTimeInterface */
    private $creationDate;

    /** @var StatusInterface */
    private $status;

    /** @var PatientAddressInterface */
    private $address;

    /** Patient constructor. */
    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
        $this->creationDate = new \DateTimeImmutable();
    }

    /** @return string */
    public function __toString(): string
    {
        return $this->getId();
    }

    /** @return string */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param $id
     *
     * @return PatientInterface
     */
    public function setId($id): PatientInterface
    {
        $this->id = $id;

        return $this;
    }

    /** @return PatientFullNameInterface */
    public function getFullName(): PatientFullNameInterface
    {
        return $this->fullName;
    }

    /**
     * @param PatientFullNameInterface $fullName
     *
     * @return PatientInterface
     */
    public function setFullName(PatientFullNameInterface $fullName): PatientInterface
    {
        $this->fullName = $fullName;

        return $this;
    }

    /** @return string */
    public function getRegionId(): string
    {
        return $this->regionId;
    }

    /**
     * @param $regionId
     *
     * @return PatientInterface
     */
    public function setRegionId($regionId): PatientInterface
    {
        $this->regionId = $regionId;

        return $this;
    }
    
    /** @return \DateTimeInterface */
    public function getCreationDate(): \DateTimeInterface
    {
        return $this->creationDate;
    }

    /**
     * @param \DateTimeInterface $creationDate
     *
     * @return PatientInterface
     */
    public function setCreationDate(\DateTimeInterface $creationDate): PatientInterface
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /** @return StatusInterface */
    public function getStatus(): StatusInterface
    {
        return $this->status;
    }

    /**
     * @param StatusInterface $status
     *
     * @return PatientInterface
     */
    public function setStatus(StatusInterface $status): PatientInterface
    {
        $this->status = $status;

        return $this;
    }

    /** @return PatientAddressInterface */
    public function getAddress(): PatientAddressInterface
    {
        return $this->address;
    }

    /**
     * @param PatientAddressInterface $address
     *
     * @return PatientInterface
     */
    public function setAddress(PatientAddressInterface $address): PatientInterface
    {
        $this->address = $address;

        return $this;
    }
}
