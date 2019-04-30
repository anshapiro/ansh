<?php

namespace App\Patient\Model\Patient\Embedded;

interface PatientAddressInterface
{
    public function getPostcode(): string;

    public function setPostcode(string $postcode): PatientAddressInterface;

    public function getCity(): string;

    public function setCity(string $city): PatientAddressInterface;

    public function getStreet(): string;

    public function setStreet(string $street): PatientAddressInterface;

    public function getHouseNumber(): ?string;

    public function setHouseNumber(?string $houseNumber): PatientAddressInterface;

    public function address(): string;
}
