<?php

namespace App\Patient\Model\Patient\Embedded;

interface PatientFullNameInterface
{
    public function getName(): string;

    public function setName(string $name): PatientFullNameInterface;

    public function getSurname(): string;

    public function setSurname(string $surname): PatientFullNameInterface;

    public function getPatronymic(): ?string;

    public function setPatronymic(?string $patronymic): PatientFullNameInterface;

    public function full(): string;

    public function short(): string;
}
