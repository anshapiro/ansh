<?php

namespace App\Patient\Model\Patient;

use App\Patient\Model\Status\StatusInterface;
use App\Patient\Model\Patient\Embedded\PatientAddressInterface;
use App\Patient\Model\Patient\Embedded\PatientFullNameInterface;

interface PatientInterface
{
    public const ALIAS = 'patient';

    public function getId();

    public function setId($id): PatientInterface;

    public function getFullName(): PatientFullNameInterface;

    public function setFullName(PatientFullNameInterface $fullName): PatientInterface;

    public function getRegionId();

    public function setRegionId($regionId): PatientInterface;

    public function getCreationDate(): \DateTimeInterface;

    public function setCreationDate(\DateTimeInterface $creationDate): PatientInterface;

    public function getStatus(): StatusInterface;

    public function setStatus(StatusInterface $status): PatientInterface;

    public function getAddress(): PatientAddressInterface;

    public function setAddress(PatientAddressInterface $address): PatientInterface;
}
