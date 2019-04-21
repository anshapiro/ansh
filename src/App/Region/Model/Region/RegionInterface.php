<?php

namespace App\Region\Model\Region;

interface RegionInterface
{
    public const ALIAS = 'region';

    public function getId();

    public function setId($id): RegionInterface;

    public function getName(): string;

    public function setName(string $name): RegionInterface;
}
