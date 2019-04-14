<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 07-Apr-19
 * Time: 8:38
 */

namespace Rest\Infrastructure\Domain\Authenticators;

use Rest\Domain\Services\Exceptions\InvalidTokenException;
use Rest\Infrastructure\Domain\User\ConstructUserFromJwtTokenService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;


class UserApiAuthenticatorService extends AbstractGuardAuthenticator
{

    private $keyword = "authorization";
    /**
     * @var ConstructUserFromJwtTokenService
     */
    private $constructUserService;

    /**
     * UserApiAuthenticatorService constructor.
     *
     * @param ConstructUserFromJwtTokenService $constructUserService
     */
    public function __construct(
        ConstructUserFromJwtTokenService $constructUserService
    ) {
        $this->constructUserService = $constructUserService;
    }

    /**
     * @param Request $request The request that resulted in an AuthenticationException
     * @param AuthenticationException $authException The exception that started the authentication process
     *
     * @return Response
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
        $data = array(
            'message' => 'Authentication Failed',
        );

        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function supports(Request $request): bool
    {
        return true;
    }

    /**
     * @param Request $request
     *
     * @return mixed Any non-null value
     *
     * @throws \UnexpectedValueException If null is returned
     * @throws \Exception
     */
    public function getCredentials(Request $request)
    {
        if(!$request->headers->has($this->keyword) && !(strpos($request->headers->get($this->keyword), 'Bearer ') !== false)){
            throw new InvalidTokenException(['token' => 'missing']);
        }
        [$tokenType, $token] = explode(' ', $request->headers->get('Authorization'));

        return [
            'token' => $token,
        ];
    }

    /**
     * @param mixed $credentials
     * @param UserProviderInterface $userProvider
     *
     * @throws AuthenticationException
     *
     * @return UserInterface|null
     */
    public function getUser($credentials, UserProviderInterface $userProvider): ?UserInterface
    {
        $user = $this->constructUserService->execute($credentials['token']);
        if ($user) {
            return $user;
        }

        return null;
    }

    /**
     * @param mixed $credentials
     * @param UserInterface $user
     *
     * @return bool
     *
     * @throws AuthenticationException
     */
    public function checkCredentials($credentials, UserInterface $user)
    {
        return true;
    }

    /**
     * @param Request $request
     * @param AuthenticationException $exception
     *
     * @return Response|null
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $data = array(
            'message' => strtr($exception->getMessageKey(), $exception->getMessageData()),

        );

        return new JsonResponse($data, Response::HTTP_FORBIDDEN);
    }

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @param string $providerKey The provider (i.e. firewall) key
     *
     * @return Response|null
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return null;
    }

    /**
     * @return bool
     */
    public function supportsRememberMe()
    {
        return false;
    }
}
