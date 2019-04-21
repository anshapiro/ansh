<?php

namespace App\Patient\Model\Region;

interface RegionRepositoryInterface
{
    public function getIds(): array;

    public function find($id);
}
