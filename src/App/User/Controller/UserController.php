<?php

namespace App\User\Controller;

use Base\Security\Voter\UserVoterInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class UserController extends AbstractController
{
    /**
     * @Route("/api/v1/users", name="api/v1/get_user_list", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function getUserList(): JsonResponse
    {
        $this->denyAccessUnlessGranted(UserVoterInterface::MANAGE_USER_ACCESS);

        return new JsonResponse(sprintf('Welcome, %s!', $this->getUser()->getFullName()->full()));
    }
}
