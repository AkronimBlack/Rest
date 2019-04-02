<?php
/**
 * Created by PhpStorm.
 * User: hr00028131
 * Date: 02.04.2019
 * Time: 13:08
 */

namespace Settings\Infrastructure\UI\Commands;


use Doctrine\ORM\EntityManagerInterface;
use Settings\Application\Service\Auth\RegisterAsClientOnAuthServerRequest;
use Settings\Application\Service\Auth\RegisterAsClientOnAuthServerService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Transactional\Transactional;

class RegisterAsClientOnAuthServerCommand extends Command
{
    use Transactional;

    /**
     * @var RouterInterface
     */
    private $router;
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
            ->setDescription('Register this app as client on an auth server!');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln($this->registerService->execute(
            new RegisterAsClientOnAuthServerRequest('temp' , 'temp')
        ));
    }
}
