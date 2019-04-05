<?php
/**
 * Created by PhpStorm.
 * User: BlackBit
 * Date: 04-Apr-19
 * Time: 18:50
 */

namespace Settings\Infrastructure\UI\Commands;


use Doctrine\ORM\EntityManagerInterface;
use Settings\Application\Service\Auth\GetPublicKeyFromAuthRequest;
use Settings\Application\Service\Auth\GetPublicKeyFromAuthService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Transactional\Transactional;

class GetPublicKeyFromAuthServerCommand extends Command
{
    use Transactional;

    /**
     * @var GetPublicKeyFromAuthService
     */
    private $getPublicKeyService;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(
        GetPublicKeyFromAuthService $getPublicKeyService,
        EntityManagerInterface $em
    ) {
        parent::__construct();
        $this->getPublicKeyService = $getPublicKeyService;
        $this->em                  = $em;
    }

    protected static $defaultName = 'security:auth:key';

    protected function configure()
    {
        $this
            ->setDescription('Register this app as client on an auth server!')
            ->addOption('username', 'u', InputOption::VALUE_REQUIRED, 'Admin username')
            ->addOption('password', 'p', InputOption::VALUE_REQUIRED, 'Admin password');
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
        $output->writeln(
            $this->getPublicKeyService->execute(
                new GetPublicKeyFromAuthRequest(
                )
            )
        );
    }
}
