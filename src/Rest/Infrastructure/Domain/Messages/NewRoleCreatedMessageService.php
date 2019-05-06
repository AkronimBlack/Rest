<?php


namespace Rest\Infrastructure\Domain\Messages;


use OldSound\RabbitMqBundle\RabbitMq\Producer;
use Rest\Domain\Entity\Role;

class NewRoleCreatedMessageService extends Producer
{
    /**
     * @param Role $role
     */
    public function publishMessage(Role $role): void
    {
        $msg = [
            'name' => $role->getName(),
            'designation' => $role->getRole()
        ];

        $this->publish(json_encode($msg));
    }
}
