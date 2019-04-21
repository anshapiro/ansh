<?php

namespace App\User\Action\User\Create;

use App\User\Model\User\UserInterface;
use App\User\Action\User\UserActionInterface;
use Base\Utils\Serializer\SerializerInterface;
use App\User\Utils\PasswordEncoder\PasswordEncoderInterface;
use Doctrine\Common\Persistence\ObjectManager;

final class CreateUserAction implements UserActionInterface
{
    /** @var ObjectManager */
    private $om;

    /** @var PasswordEncoderInterface */
    private $passwordEncoder;

    /** @var SerializerInterface */
    private $serializer;

    /**
     * CreateRegionAction constructor.
     *
     * @param ObjectManager $om
     * @param PasswordEncoderInterface $passwordEncoder
     * @param SerializerInterface $serializer
     */
    public function __construct(
        ObjectManager $om,
        PasswordEncoderInterface $passwordEncoder,
        SerializerInterface $serializer
    ) {
        $this->om = $om;
        $this->passwordEncoder = $passwordEncoder;
        $this->serializer = $serializer;
    }

    /**
     * @param array $data
     * @param UserInterface|null $user
     *
     * @return UserInterface
     */
    public function perform(array $data, ?UserInterface $user = null): UserInterface
    {
        $this->hashPassword($data);

        $newUser = $this->serializer->deserialize($data, self::OBJECT_CLASS);
        $this->om->persist($newUser);

        return $newUser;
    }

    /** @param array $data */
    private function hashPassword(array &$data): void
    {
        $password = $data['password'] ?? UserInterface::DEFAULT_PASSWORD;

        $data['password'] = $this->passwordEncoder->encode($password);
    }
}
