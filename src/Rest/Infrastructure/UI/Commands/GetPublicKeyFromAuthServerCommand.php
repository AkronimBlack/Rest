<?php

namespace Rest\Infrastructure\UI\Commands;


use Rest\Application\Service\Auth\GetPublicKeyFromAuthRequest;
use Rest\Application\Service\Auth\GetPublicKeyFromAuthService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transactional\Transactional;

class GetPublicKeyFromAuthServerCommand extends Command
{
    use Transactional;

    /**
     * @var GetPublicKeyFromAuthService
     */
    private $getPublicKeyService;

    public function __construct(
        GetPublicKeyFromAuthService $getPublicKeyService
    ) {
        parent::__construct();
        $this->getPublicKeyService = $getPublicKeyService;
    }

    protected static $defaultName = 'security:auth:key';

    protected function configure()
    {
        $this
            ->setDescription('Get public key from authentication server!');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return int|void|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getPublicKeyService->execute(
            new GetPublicKeyFromAuthRequest(
            )
        );
    }
}
