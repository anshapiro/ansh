<?php

namespace App\User\Action\User\Update;

use App\User\Model\User\UserInterface;
use App\User\Action\User\UserActionInterface;
use App\User\Exception\UserNotFoundException;
use App\User\Utils\PasswordEncoder\PasswordEncoderInterface;
use Base\Utils\Serializer\SerializerInterface;
use Doctrine\Common\Persistence\ObjectManager;

final class UpdateUserAction implements UserActionInterface
{
    /** @var ObjectManager */
    private $om;

    /** @var SerializerInterface */
    private $serializer;

    /** @var PasswordEncoderInterface */
    private $passwordEncoder;

    /**
     * UpdateUserAction constructor.
     *
     * @param ObjectManager $om
     * @param SerializerInterface $serializer
     * @param PasswordEncoderInterface $passwordEncoder
     */
    public function __construct(
        ObjectManager $om,
        SerializerInterface $serializer,
        PasswordEncoderInterface $passwordEncoder
    ) {
        $this->om = $om;
        $this->serializer = $serializer;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param array $data
     * @param UserInterface|null $user
     *
     * @throws UserNotFoundException
     *
     * @return UserInterface
     */
    public function perform(array $data, ?UserInterface $user = null): UserInterface
    {
        if ($user === null) {
            throw new UserNotFoundException();
        }

        if (\array_key_exists('password', $data)) {
            $this->hashPassword($data);
        }

        $user = $this->serializer->deserialize($data, self::OBJECT_CLASS, [
            'object_to_populate' => $user,
        ]);
        $this->om->persist($user);

        return $user;
    }

    /** @param array $data */
    private function hashPassword(array &$data): void
    {
        $data['password'] = $this->passwordEncoder->encode($data['password']);
    }
}
