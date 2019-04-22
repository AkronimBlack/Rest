<?php

namespace Rest\Application\Service\User;


use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Rest\Domain\Entity\User\User;
use Rest\Domain\Entity\User\UserSettings;
use Transactional\Interfaces\TransactionalServiceInterface;

class ViewUserSettingsService implements TransactionalServiceInterface
{
    private $userRepository;

    public function __construct(EntityManagerInterface $em)
    {
        $this->userRepository = $em->getRepository(User::class);
    }

    /**
     * @param ViewUserSettingsRequest $request
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     *
     */
    public function execute($request = null)
    {

        $user = $this->userRepository->byIdentifier($request->getValidatedUser()->getUsername());
        if(!$user){
            $user = new User(
                $request->getValidatedUser()->getUsername()
            );
            $this->userRepository->persist($user);
        }

        if(empty($user->getSettingsForApp($request->getAppId()))){
            $userSettings = new UserSettings(
                $user,
                $request->getAppId()
            );
            $user->addSettings($userSettings);
        }

        return $user->getSettingsForApp($request->getAppId());
    }
}
