<?php

namespace Base\Security\Voter;

use Base\Model\BaseUserInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

final class UserVoter extends Voter implements UserVoterInterface
{
    /**
     * @param string $attribute
     * @param mixed $subject
     *
     * @return bool
     */
    protected function supports($attribute, $subject): bool
    {
        if (\in_array($attribute, self::PERMISSIONS, true)) {
            return false;
        }

        if ($subject !== null && !$subject instanceof BaseUserInterface) {
            return false;
        }

        return true;
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
        /** @var BaseUserInterface $user */
        $user = $token->getUser();

        if (!$user instanceof BaseUserInterface) {
            return false;
        }

        switch ($attribute) {
            case self::MANAGE_USER_ACCESS:
                return $this->hasManageUserAccess($user);
            case self::CREATE_USER_ACCESS:
                return $user->hasCreateUserAccess();
            case self::VIEW_USER_ACCESS:
                return $user->hasViewUserAccess();
            case self::EDIT_USER_ACCESS:
                return $user->hasEditUserAccess();
            default:
                return $user->hasPermission($attribute);
        }
    }

    /**
     * @param BaseUserInterface $user
     *
     * @return bool
     */
    private function hasManageUserAccess(BaseUserInterface $user): bool
    {
        return $this->hasCreateUserAccess($user) && $this->hasViewUserAccess($user) && $this->hasEditUserAccess($user);
    }

    /**
     * @param BaseUserInterface $user
     *
     * @return bool
     */
    private function hasCreateUserAccess(BaseUserInterface $user): bool
    {
        return $user->hasCreateUserAccess();
    }

    /**
     * @param BaseUserInterface $user
     *
     * @return bool
     */
    private function hasViewUserAccess(BaseUserInterface $user): bool
    {
        return $user->hasViewUserAccess();
    }

    /**
     * @param BaseUserInterface $user
     *
     * @return bool
     */
    private function hasEditUserAccess(BaseUserInterface $user): bool
    {
        return $user->hasEditUserAccess();
    }
}
