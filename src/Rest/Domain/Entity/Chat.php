<?php


namespace Rest\Domain\Entity;


use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;
use Rest\Infrastructure\Domain\User\ConstructUserFromJwtTokenService;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Chat implements MessageComponentInterface
{
    protected $connections = array();
    /**
     * @var ConstructUserFromJwtTokenService
     */
    private $constructUserFromJwtTokenService;


    public function __construct(
        ConstructUserFromJwtTokenService $constructUserFromJwtTokenService
    )
    {
        $this->constructUserFromJwtTokenService = $constructUserFromJwtTokenService;
    }

    /**
     * When a new connection is opened it will be passed to this method
     * @param ConnectionInterface $conn The socket/connection that just connected to your application
     * @throws \Exception
     */
    function onOpen(ConnectionInterface $conn)
    {
        $this->connections[] = $conn;
        $conn->send('..:: Hello from the Notification Center ::..');
        echo "New connection \n";
    }

    /**
     * This is called before or after a socket is closed (depends on how it's closed).  SendMessage to $conn will not result in an error if it has already been closed.
     * @param ConnectionInterface $conn The socket/connection that is closing/closed
     * @throws \Exception
     */
    function onClose(ConnectionInterface $conn)
    {
        // TODO: Implement onClose() method.
    }

    /**
     * If there is an error with one of the sockets, or somewhere in the application where an Exception is thrown,
     * the Exception is sent back down the stack, handled by the Server and bubbled back up the application through this method
     * @param ConnectionInterface $conn
     * @param \Exception $e
     * @throws \Exception
     */
    function onError(ConnectionInterface $conn, \Exception $e)
    {
        // TODO: Implement onError() method.
    }

    /**
     * Triggered when a client sends data through the socket
     * @param \Ratchet\ConnectionInterface $from The socket/connection that sent the message to your application
     * @param string $msg The message received
     * @throws \Exception
     */
    function onMessage(ConnectionInterface $from, $msg)
    {
        $numRecv = count($this->connections) - 1;
        echo 'message';

        foreach ($this->connections as $client) {
            if ($from !== $client) {
                // The sender is not the receiver, send to each client connected
                $client->send($msg);
            }
        }
    }
}