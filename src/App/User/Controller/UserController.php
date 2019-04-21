<?php

namespace App\User\Controller;

use App\User\Model\User\UserInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\User\Model\Permission\PermissionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class UserController extends AbstractController
{
    /**
     * @Route("/users", name="users", methods={"GET"})
     *
     * @return JsonResponse
     */
    public function users(): JsonResponse
    {
        /** @var UserInterface $user */
        $user = $this->getUser();

        $this->denyAccessUnlessGranted(PermissionInterface::VIEW_USER_PERMISSION, $user);

        return new JsonResponse(sprintf('Welcome, %s!', $user->getFullName()->full()));
    }
}
