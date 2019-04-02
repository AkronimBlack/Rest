<?php
/**
 * Created by PhpStorm.
 * User: hr00028131
 * Date: 02.04.2019
 * Time: 13:08
 */

namespace Settings\Infrastructure\UI\Commands;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
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
     * @var ImportRoutesForPermissionService
     */
    private $importService;

    public function __construct(
        EntityManagerInterface $em
    ) {
        parent::__construct();
        $this->em            = $em;
    }

    protected static $defaultName = 'security:auth:register';

    protected function configure()
    {
        $this
            ->setDescription('Import all defined routes!')
            ->addOption('clean' , null , InputOption::VALUE_NONE , 'Remove routes in DB that are no longer used in any controller');
    }
}
