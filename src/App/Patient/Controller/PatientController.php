<?php

namespace App\Patient\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Patient\Handler\Patient\GetPatientListHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class PatientController extends AbstractController
{
    /**
     * @Route("/api/v1/patients", name="api_v1_get_patient_list", methods={"GET"})
     *
     * @param GetPatientListHandler $handler
     *
     * @return JsonResponse
     */
    public function getPatientList(GetPatientListHandler $handler, Request $request): JsonResponse
    {
        return new JsonResponse($handler->handle($request->query->all()));
    }
}
