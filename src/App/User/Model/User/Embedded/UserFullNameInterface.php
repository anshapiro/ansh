<?php

namespace App\User\Model\User\Embedded;

interface UserFullNameInterface
{
    public function getName(): string;

    public function setName(string $name): UserFullNameInterface;

    public function getSurname(): string;

    public function setSurname(string $surname): UserFullNameInterface;

    public function getPatronymic(): ?string;

    public function setPatronymic(?string $patronymic): UserFullNameInterface;

    public function full(): string;

    public function short(): string;
}
