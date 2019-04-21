<?php

namespace App\Patient\Action\Patient;

use App\Patient\Model\Patient\Patient;
use App\Patient\Model\Patient\PatientInterface;

interface PatientActionInterface
{
    public const OBJECT_CLASS = Patient::class;

    public function perform(array $data, ?PatientInterface $patient = null): PatientInterface;
}
