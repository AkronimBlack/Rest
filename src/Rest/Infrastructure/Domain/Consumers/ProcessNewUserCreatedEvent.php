<?php


namespace Rest\Infrastructure\Domain\Consumers;


use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;

class ProcessNewUserCreatedEvent implements ConsumerInterface
{

    /**
     * @param AMQPMessage $msg The message
     *
     * @return mixed false to reject and requeue, any other value to acknowledge
     */
    public function execute(AMQPMessage $msg)
    {
        // TODO: Implement execute() method.
    }
}
