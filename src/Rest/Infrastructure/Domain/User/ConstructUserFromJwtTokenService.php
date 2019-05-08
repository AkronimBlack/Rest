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
use Rest\Infrastructure\Domain\Cache\RedisCacheService;
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
     * @var RedisCacheService
     */
    private $cache;

    /**
     * ConstructUserFromJwtTokenService constructor.
     *
     * @param $projectDir
     * @param $publicKeyLocation
     * @param EntityManagerInterface $em
     * @param RedisCacheService $cache
     */
    public function __construct(
        $projectDir,
        $publicKeyLocation,
        EntityManagerInterface $em,
        RedisCacheService $cache
    ) {
        $this->projectDir        = $projectDir;
        $this->publicKeyLocation = $publicKeyLocation;
        $this->roleRepository    = $em->getRepository(Role::class);
        $this->cache             = $cache;
    }

    public function execute(string $token): UserValidationInterface
    {
        $publicKey   = file_get_contents($this->projectDir . $this->publicKeyLocation);
        $userData    = JWT::decode($token, $publicKey, ['RS256']);
        $roles       = $this->getRolesFromCache();
        if (isset($userData->rol)) {
            $userRoles = [];
            foreach ($userData->rol as $role) {
                foreach ($roles as $sysRole) {
                    if ($sysRole->getRole() === $role) {
                        $userRoles[] = $sysRole;
                    }
                }
            }
        } else {
            throw new InvalidTokenException(['Roles' => 'missing']);
        }

        if ( ! isset($userData->uid)) {
            throw new InvalidTokenException(['UID' => 'missing']);
        }

        return new ValidatedUser(
            $userData->usn,
            $userRoles,
            $userData->uid
        );

    }

    private function getRolesFromCache()
    {
        $cache       = $this->cache->getCache();
        $cachedRoles = $cache->getItem('roles');
        $rolesArray  = [];
        if ( ! $cachedRoles->isHit()) {
            $roles = $this->roleRepository->findAll();
            /**
             * @var Role $role
             */
            foreach ($roles as $role) {
                $rolePermissions = [];
                foreach ($role->getPermissions() as $permission){
                    $rolePermissions[] = $permission;
                }
                $rolesArray[] = [
                    'role'        => $role,
                    'permissions' => $rolePermissions,
                ];
            }
            $cachedRoles->set($rolesArray);
            $cache->save($cachedRoles);
        }
        $roles = [];
        foreach ($cachedRoles->get() as $roleData){
            /**
             * @var Role $role
             */
            $role = $roleData['role'];
            foreach ($roleData['permissions'] as $permission){
                $role->addPermission($permission);
            }
            $roles[] = $role;
        }
        return $roles;
    }
}
