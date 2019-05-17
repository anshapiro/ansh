<?php

namespace App\Patient\Model\Patient\Embedded;

final class PatientPhone implements PatientPhoneInterface
{
    /** @var string */
    private $countryCode;

    /** @var string */
    private $phoneCode;

    /** @var string */
    private $phoneNumber;

    /** @return string */
    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    /**
     * @param string $countryCode
     *
     * @return PatientPhoneInterface
     */
    public function setCountryCode(string $countryCode): PatientPhoneInterface
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    /** @return string */
    public function getPhoneCode(): string
    {
        return $this->phoneCode;
    }

    /**
     * @param string $phoneCode
     *
     * @return PatientPhoneInterface
     */
    public function setPhoneCode(string $phoneCode): PatientPhoneInterface
    {
        $this->phoneCode = $phoneCode;

        return $this;
    }

    /** @return string */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string $phoneNumber
     *
     * @return PatientPhoneInterface
     */
    public function setPhoneNumber(string $phoneNumber): PatientPhoneInterface
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /** @return string */
    public function full(): string
    {
        return '+' . $this->getCountryCode() . ' (' . $this->getPhoneCode() . ') ' . $this->getPhoneNumber();
    }

    /** @return string */
    public function short(): string
    {
        return '(' . $this->getPhoneCode() . ') ' . $this->getPhoneNumber();
    }
}
