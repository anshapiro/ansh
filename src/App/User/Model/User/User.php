<?php

namespace App\User\Model\User;

use Ramsey\Uuid\Uuid;
use Base\Model\BaseUserInterface;
use App\User\Model\Permission\Permission;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\User\Model\Permission\PermissionInterface;
use App\User\Model\User\Embedded\UserFullNameInterface;
use Symfony\Component\Security\Core\User\UserInterface as SymfonyUserInterface;

class User implements UserInterface, BaseUserInterface, SymfonyUserInterface
{
    #################### CLASS PROPERTIES ####################

    /** @var string */
    private $id;

    /** @var string */
    private $username;

    /** @var string */
    private $email;

    /** @var string */
    private $password;

    /** @var UserFullNameInterface */
    private $fullName;

    /** @var ArrayCollection */
    private $permissions;

    /** @var null|string */
    private $regionId;

    #################### END OF CLASS PROPERTIES ####################

    #################### MAGIC METHODS ####################

    /** Permission constructor. */
    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
        $this->permissions = new ArrayCollection();
    }

    /** @return string */
    public function __toString(): string
    {
        return $this->getId();
    }

    #################### MAGIC METHODS ####################

    #################### USER INTERFACE ####################

    /** @return string */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param $id
     *
     * @return UserInterface
     */
    public function setId($id): UserInterface
    {
        $this->id = $id;

        return $this;
    }

    /** @return string */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     *
     * @return UserInterface
     */
    public function setUsername(string $username): UserInterface
    {
        $this->username = $username;

        return $this;
    }

    /** @return string */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return UserInterface
     */
    public function setEmail(string $email): UserInterface
    {
        $this->email = $email;

        return $this;
    }

    /** @return string */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     *
     * @return UserInterface
     */
    public function setPassword(string $password): UserInterface
    {
        $this->password = $password;

        return $this;
    }

    /** @return UserFullNameInterface */
    public function getFullName(): UserFullNameInterface
    {
        return $this->fullName;
    }

    /**
     * @param UserFullNameInterface $fullName
     *
     * @return UserInterface
     */
    public function setFullName(UserFullNameInterface $fullName): UserInterface
    {
        $this->fullName = $fullName;

        return $this;
    }

    /** @return Collection */
    public function getPermissions(): Collection
    {
        return $this->permissions;
    }

    /**
     * @param array $permissions
     *
     * @return UserInterface
     */
    public function setPermissions(array $permissions): UserInterface
    {
        $this->permissions = new ArrayCollection($permissions);

        return $this;
    }

    /**
     * @param PermissionInterface $permission
     *
     * @return UserInterface
     */
    public function addPermission(PermissionInterface $permission): UserInterface
    {
        if (!$this->permissions->contains($permission)) {
            $this->permissions->add($permission);
        }

        return $this;
    }

    /**
     * @param PermissionInterface $permission
     *
     * @return UserInterface
     */
    public function removePermission(PermissionInterface $permission): UserInterface
    {
        if ($this->permissions->contains($permission)) {
            $this->permissions->removeElement($permission);
        }

        return $this;
    }

    /** @return null|string */
    public function getRegionId(): ?string
    {
        return $this->regionId;
    }

    /**
     * @param $regionId
     *
     * @return UserInterface
     */
    public function setRegionId($regionId): UserInterface
    {
        $this->regionId = $regionId;

        return $this;
    }

    #################### END OF USER INTERFACE ####################

    #################### BASE USER INTERFACE ####################

    /** @return bool */
    public function hasCreateUserAccess(): bool
    {
        return $this->hasPermission(PermissionInterface::CREATE_USER_PERMISSION);
    }

    /** @return bool */
    public function hasViewUserAccess(): bool
    {
        return $this->hasPermission(PermissionInterface::VIEW_USER_PERMISSION);
    }

    /** @return bool */
    public function hasEditUserAccess(): bool
    {
        return $this->hasPermission(PermissionInterface::EDIT_USER_PERMISSION);
    }

    /**
     * @param string $permission
     *
     * @return bool
     */
    public function hasPermission(string $permission): bool
    {
        return $this->getPermissions()->exists(function ($key, Permission $element) use ($permission) {
            return $element->getId() === $permission;
        });
    }

    #################### END OF BASE USER INTERFACE

    #################### SYMFONY USER INTERFACE ####################

    /** @return array */
    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function getSalt(): void {}

    public function eraseCredentials(): void {}

    #################### END OF SYMFONY USER INTERFACE ####################
}
