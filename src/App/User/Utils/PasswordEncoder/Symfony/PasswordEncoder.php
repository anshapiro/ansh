<?php

namespace App\User\Utils\PasswordEncoder\Symfony;

use App\User\Model\User\UserInterface;
use App\User\Utils\PasswordEncoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface as SymfonyPasswordEncoderInterface;

final class PasswordEncoder implements PasswordEncoderInterface
{
    /** @var string */
    private $salt;

    /** @var EncoderFactoryInterface */
    private $encoder;

    /**
     * PasswordEncoder constructor.
     *
     * @param string $salt
     * @param EncoderFactoryInterface $encoder
     */
    public function __construct(string $salt, EncoderFactoryInterface $encoder)
    {
        $this->salt = $salt;
        $this->encoder = $encoder;
    }

    /**
     * @param string $password
     *
     * @return string
     */
    public function encode(string $password): string
    {
        return $this->getEncoder()->encodePassword($password, $this->salt);
    }

    /**
     * @param $user
     * @param string $password
     *
     * @return bool
     */
    public function isValid(UserInterface $user, string $password): bool
    {
        return $this->getEncoder()->isPasswordValid($user->getPassword(), $password, $this->salt);
    }

    /** @return SymfonyPasswordEncoderInterface */
    private function getEncoder(): SymfonyPasswordEncoderInterface
    {
        return $this->encoder->getEncoder(self::USER_CLASS);
    }
}
