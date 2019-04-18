<?php

namespace Rest\Application\Service\User;


use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;

class ViewUserSettingsService
{
    /**
     * @param ViewUserSettingsRequest $request
     *
     * @return \Doctrine\Common\Collections\ArrayCollection
     *
     */
    public function execute($request = null)
    {
        $settings = $request->getUser()->getSettings();



        return $settings;
    }
}
