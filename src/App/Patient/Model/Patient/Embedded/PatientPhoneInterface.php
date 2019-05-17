<?php

namespace App\Patient\Model\Patient\Embedded;

interface PatientPhoneInterface
{
    public function getCountryCode(): string;

    public function setCountryCode(string $countryCode): PatientPhoneInterface;

    public function getPhoneCode(): string;

    public function setPhoneCode(string $phoneCode): PatientPhoneInterface;

    public function getPhoneNumber(): string;

    public function setPhoneNumber(string $phoneNumber): PatientPhoneInterface;

    public function full(): string;

    public function short(): string;
}
