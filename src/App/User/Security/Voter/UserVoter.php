<?php

namespace App\User\Security\Voter;

use App\User\Model\User\UserInterface;
use App\User\Model\Permission\PermissionInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

final class UserVoter extends Voter
{
    /**
     * @param string $attribute
     * @param mixed $subject
     *
     * @return bool
     */
    protected function supports($attribute, $subject): bool
    {
        return
            \in_array($attribute, PermissionInterface::PERMISSIONS, true)
            && $subject instanceof UserInterface;
    }

    /**
     * @param string $attribute
     * @param mixed $subject
     * @param TokenInterface $token
     *
     * @return bool
     */
    protected function voteOnAttribute($attribute, $subject, TokenInterface $token): bool
    {
        /** @var UserInterface $user */
        $user = $token->getUser();

        if (!$user instanceof UserInterface) {
            return false;
        }

        switch ($attribute) {
            case PermissionInterface::CREATE_USER_PERMISSION:
                return $user->hasCreateUserAccess();
            case PermissionInterface::VIEW_USER_PERMISSION:
                return $user->hasViewUserAccess();
            case PermissionInterface::EDIT_USER_PERMISSION:
                return $user->hasEditUserAccess();
            default:
                return $user->hasPermission($attribute);
        }
    }
}
