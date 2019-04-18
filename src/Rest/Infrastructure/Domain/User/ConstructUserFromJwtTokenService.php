<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 14-Apr-19
 * Time: 9:38
 */

namespace Rest\Infrastructure\Domain\User;


use Doctrine\ORM\EntityManagerInterface;
use Firebase\JWT\JWT;
use Rest\Domain\Entity\Role;
use Rest\Domain\Entity\User\User;
use Rest\Domain\Entity\User\UserValidationInterface;
use Rest\Domain\Services\Exceptions\InvalidTokenException;
use Rest\Infrastructure\Repositories\RoleRepository;

class ConstructUserFromJwtTokenService
{
    private $projectDir;
    private $publicKeyLocation;
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * ConstructUserFromJwtTokenService constructor.
     *
     * @param $projectDir
     * @param $publicKeyLocation
     * @param EntityManagerInterface $em
     */
    public function __construct(
        $projectDir,
        $publicKeyLocation,
        EntityManagerInterface $em
    ) {
        $this->projectDir        = $projectDir;
        $this->publicKeyLocation = $publicKeyLocation;
        $this->roleRepository    = $em->getRepository(Role::class);
    }

    public function execute(string $token): UserValidationInterface
    {
        $publicKey = file_get_contents($this->projectDir . $this->publicKeyLocation);
        $userData  = JWT::decode($token, $publicKey, ['RS256']);

        if ($userData->rol) {
            $userRoles = [];
            foreach ($userData->rol as $role) {
                $userRoles[] = $this->roleRepository->findByReference($role);
            }
        }else{
            throw new InvalidTokenException(['Roles' => 'missing']);
        }

        return new ValidatedUser(
            $userData->usn,
            $userRoles
        );

    }
}
