<?php

namespace App\Patient\Model\Patient\Embedded;

final class PatientAddress implements PatientAddressInterface
{
    /** @var string */
    private $postcode;

    /** @var string */
    private $city;

    /** @var string */
    private $street;

    /** @var string|null */
    private $houseNumber;

    /** @return string */
    public function __toString(): string
    {
        return $this->address();
    }

    /** @return string */
    public function getPostcode(): string
    {
        return $this->postcode;
    }

    /**
     * @param string $postcode
     *
     * @return PatientAddressInterface
     */
    public function setPostcode(string $postcode): PatientAddressInterface
    {
        $this->postcode = $postcode;

        return $this;
    }

    /** @return string */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     *
     * @return PatientAddressInterface
     */
    public function setCity(string $city): PatientAddressInterface
    {
        $this->city = $city;

        return $this;
    }

    /** @return string */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @param string $street
     *
     * @return PatientAddressInterface
     */
    public function setStreet(string $street): PatientAddressInterface
    {
        $this->street = $street;

        return $this;
    }

    /** @return string|null */
    public function getHouseNumber(): ?string
    {
        return $this->houseNumber;
    }

    /**
     * @param string|null $houseNumber
     *
     * @return PatientAddressInterface
     */
    public function setHouseNumber(?string $houseNumber): PatientAddressInterface
    {
        $this->houseNumber = $houseNumber;

        return $this;
    }

    /** @return string */
    public function address(): string
    {
        return implode(', ', [
            $this->getPostcode(),
            $this->getCity(),
            $this->getStreet(),
            $this->getHouseNumber(),
        ]);
    }
}
