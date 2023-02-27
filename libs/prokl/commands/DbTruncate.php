<?php

namespace Prokl\Commands;

use Bitrix\Main\Config\Configuration;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class DbTruncate
 */
class DbTruncate extends Command
{
    /**
     * @var mixed $connection
     */
    private $connection;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->connection = Configuration::getValue('connections')['default'];
        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setName('db:truncate')
            ->setDescription('Truncate table')
            ->addArgument(
                'table',
                InputArgument::REQUIRED,
                'Table name'
            );
    }

    /**
     * Исполнение команды.
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return integer
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        [
            'host' => $dbHost,
            'database' => $dbName,
            'login' => $dbLogin,
            'password' => $dbPassword
        ] = $this->connection;

        if (!$dbHost || !$dbName || !$dbLogin) {
            $output->writeln('Env variables for database empty.');

            return 1;
        }

        $connection = \Bitrix\Main\Application::getConnection();
        $connection->truncateTable($input->getArgument('table'));

        $output->writeln('Truncate table completed.');

        return 0;
    }
}
