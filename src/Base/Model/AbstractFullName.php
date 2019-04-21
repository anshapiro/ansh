<?php

namespace Base\Model;

abstract class AbstractFullName
{
    protected $name;

    protected $surname;

    protected $patronymic;

    public function __toString(): string
    {
        return $this->full();
    }

    public function getName(): string
    {
        return $this->name;
    }

    abstract public function setName(string $name);

    public function getSurname(): string
    {
        return $this->surname;
    }

    abstract public function setSurname(string $surname);

    public function getPatronymic(): ?string
    {
        return $this->patronymic;
    }

    abstract public function setPatronymic(?string $patronymic);

    public function full(): string
    {
        $full = sprintf('%s %s', $this->getSurname(), $this->getName());

        if ($this->getPatronymic() !== null) {
            $full = sprintf('%s %s', $full, $this->getPatronymic());
        }

        return $full;
    }

    public function short(): string
    {
        $full = sprintf('%s %s.', $this->getSurname(), $this->getName()[0]);

        if ($this->getPatronymic() !== null) {
            $full = sprintf('%s %s.', $full, $this->getPatronymic()[0]);
        }

        return $full;
    }
}
