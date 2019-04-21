<?php

namespace App\Region\Action\Region;

use App\Region\Model\Region\Region;
use App\Region\Model\Region\RegionInterface;

interface RegionActionInterface
{
    public const OBJECT_CLASS = Region::class;

    public function perform(array $data, ?RegionInterface $patient = null): RegionInterface;
}
