<?php

namespace Rest\Infrastructure\UI\Commands;


use Doctrine\ORM\EntityManagerInterface;
use Rest\Application\Service\Auth\RegisterAsClientOnAuthServerRequest;
use Rest\Application\Service\Auth\RegisterAsClientOnAuthServerService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Transactional\Transactional;

class RegisterAsClientOnAuthServerCommand extends Command
{
    use Transactional;
    /**
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var RegisterAsClientOnAuthServerService
     */
    private $registerService;

    public function __construct(
        EntityManagerInterface $em,
        RegisterAsClientOnAuthServerService $registerService
    ) {
        parent::__construct();
        $this->em              = $em;
        $this->registerService = $registerService;
    }

    protected static $defaultName = 'security:auth:register';

    protected function configure()
    {
        $this
            ->setDescription('Register this app as client on an auth server!')
            ->addOption('username' , 'u' , InputOption::VALUE_REQUIRED , 'Admin username')
            ->addOption('password' , 'p' , InputOption::VALUE_REQUIRED , 'Admin password')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln($this->registerService->execute(
            new RegisterAsClientOnAuthServerRequest($input->getOption('username') , $input->getOption('password'))
        ));
    }
}
