<?php

namespace App\Patient\Model\Patient\Embedded;

use Base\Model\AbstractFullName;

final class PatientFullName extends AbstractFullName implements PatientFullNameInterface
{
    /**
     * @param string $name
     *
     * @return PatientFullNameInterface
     */
    public function setName(string $name): PatientFullNameInterface
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string $surname
     *
     * @return PatientFullNameInterface
     */
    public function setSurname(string $surname): PatientFullNameInterface
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * @param null|string $patronymic
     *
     * @return PatientFullNameInterface
     */
    public function setPatronymic(?string $patronymic): PatientFullNameInterface
    {
        $this->patronymic = $patronymic;

        return $this;
    }
}
