<?php


namespace Rest\Infrastructure\UI\Commands;


use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use Rest\Domain\Entity\Chat;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class StartWebSocketServerCommand extends Command
{

    /**
     * @var Chat
     */
    private $chat;

    public function __construct(Chat $chat)
    {
        parent::__construct();
        $this->chat = $chat;
    }

    protected static $defaultName = 'sockets:chat:start';

    protected function configure()
    {
        $this
            ->setDescription('Start Ratchet Web Sockets server');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    $this->chat
                )
            ),
            8110
        );

        $server->run();
    }
}