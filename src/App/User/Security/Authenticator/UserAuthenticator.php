<?php

namespace App\User\Security\Authenticator;

use App\User\Exception\UserNotFoundException;
use App\User\Model\User\UserInterface;
use App\User\Exception\ForbiddenException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Csrf\CsrfToken;
use App\User\Model\User\UserRepositoryInterface;
use Base\Utils\UrlGenerator\UrlGeneratorInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use App\User\Utils\PasswordEncoder\PasswordEncoderInterface;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Core\User\UserInterface as SymfonyUserInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;

final class UserAuthenticator extends AbstractFormLoginAuthenticator
{
    use TargetPathTrait;

    /** @var UrlGeneratorInterface */
    private $urlGenerator;

    /** @var CsrfTokenManagerInterface */
    private $csrfTokenManager;

    /** @var PasswordEncoderInterface */
    private $passwordEncoder;

    /** @var UserRepositoryInterface */
    private $userRepository;

    /**
     * UserAuthenticator constructor.
     *
     * @param UrlGeneratorInterface $urlGenerator
     * @param CsrfTokenManagerInterface $csrfTokenManager
     * @param PasswordEncoderInterface $passwordEncoder
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(
        UrlGeneratorInterface $urlGenerator,
        CsrfTokenManagerInterface $csrfTokenManager,
        PasswordEncoderInterface $passwordEncoder,
        UserRepositoryInterface $userRepository
    ) {
        $this->urlGenerator = $urlGenerator;
        $this->csrfTokenManager = $csrfTokenManager;
        $this->passwordEncoder = $passwordEncoder;
        $this->userRepository = $userRepository;
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function supports(Request $request): bool
    {
        return ('app_login' === $request->attributes->get('_route')) && $request->isMethod('POST');
    }

    /**
     * @param Request $request
     *
     * @throws \Exception
     *
     * @return array
     */
    public function getCredentials(Request $request): array
    {
        if (($session = $request->getSession()) === null) {
            throw new ForbiddenException('Invalid request session');
        }

        $credentials = [
            'username' => $request->request->get('username'),
            'password' => $request->request->get('password'),
            'csrf_token' => $request->request->get('_csrf_token'),
        ];

        $session->set(Security::LAST_USERNAME, $credentials['username']);

        return $credentials;
    }

    /**
     * @param mixed $credentials
     * @param UserProviderInterface $userProvider
     *
     * @return UserInterface
     */
    public function getUser($credentials, UserProviderInterface $userProvider): UserInterface
    {
        $token = new CsrfToken('authenticate', $credentials['csrf_token']);

        if (!$this->csrfTokenManager->isTokenValid($token)) {
            throw new InvalidCsrfTokenException('Invalid token', 403);
        }

        $user = $this->userRepository->findOneBy(['username' => $credentials['username']]);

        if ($user === null) {
            throw new UserNotFoundException(
                sprintf(
                    'User with username "%s" not found',
                    UserNotFoundException::createPlaceholder('username')
                ),
                ['username' => $credentials['username']]
            );
        }

        return $this->userRepository->findOneBy(['username' => $credentials['username']]);
    }

    /**
     * @param mixed $credentials
     * @param SymfonyUserInterface $user
     *
     * @return bool
     */
    public function checkCredentials($credentials, SymfonyUserInterface $user): bool
    {
        if (!$user instanceof UserInterface) {
            return false;
        }

        return $this->passwordEncoder->isValid($user, $credentials['password']);
    }

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @param string $providerKey
     *
     * @throws \Exception
     *
     * @return RedirectResponse
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey): RedirectResponse
    {
        if ($targetPath = $this->getTargetPath($request->getSession(), $providerKey)) {
            return new RedirectResponse($targetPath);
        }

        return new RedirectResponse($this->urlGenerator->generate('users'));
    }

    /** @return string */
    protected function getLoginUrl(): string
    {
        return $this->urlGenerator->generate('app_login');
    }
}
