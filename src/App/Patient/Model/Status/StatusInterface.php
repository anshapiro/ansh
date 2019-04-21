<?php

namespace App\Patient\Model\Status;

interface StatusInterface
{
    public const ALIAS = 'status';

    public const DEFAULT_STATUS_NAME = 'New';

    public function getId();

    public function setId($id): StatusInterface;

    public function getName(): string;

    public function setName(string $name): StatusInterface;
}
