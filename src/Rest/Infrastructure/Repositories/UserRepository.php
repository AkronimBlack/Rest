<?php


namespace Rest\Infrastructure\Repositories;


use Doctrine\ORM\EntityRepository;
use Rest\Domain\Entity\User\User;

class UserRepository extends EntityRepository
{
    public function byIdentifier(string $identifier)
    {
        return $this->findOneBy(['identifier' => $identifier]);
    }

    public function persist(User $user): void
    {
        $this->getEntityManager()->persist($user);
    }
}
