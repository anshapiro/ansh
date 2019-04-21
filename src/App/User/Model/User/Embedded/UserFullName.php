<?php

namespace App\User\Model\User\Embedded;

use Base\Model\AbstractFullName;

final class UserFullName extends AbstractFullName implements UserFullNameInterface
{
    /**
     * @param string $name
     *
     * @return UserFullNameInterface
     */
    public function setName(string $name): UserFullNameInterface
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string $surname
     *
     * @return UserFullNameInterface
     */
    public function setSurname(string $surname): UserFullNameInterface
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * @param null|string $patronymic
     *
     * @return UserFullNameInterface
     */
    public function setPatronymic(?string $patronymic): UserFullNameInterface
    {
        $this->patronymic = $patronymic;

        return $this;
    }
}
