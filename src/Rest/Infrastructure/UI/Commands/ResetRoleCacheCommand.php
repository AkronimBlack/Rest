<?php


namespace Rest\Infrastructure\UI\Commands;


use Rest\Infrastructure\Domain\Role\ImportRolesToCacheService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ResetRoleCacheCommand extends Command
{
    /**
     * @var ImportRolesToCacheService
     */
    private $importRolesService;

    public function __construct(ImportRolesToCacheService $importRolesService)
    {

        parent::__construct('security:roles:reset');
        $this->importRolesService = $importRolesService;
    }

    protected function configure()
    {
        $this
            ->setDescription('Reset Role Cache pool!')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(
            $this->importRolesService->execute()
        );
    }
}
