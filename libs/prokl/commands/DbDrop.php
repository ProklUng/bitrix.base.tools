<?php

namespace Prokl\Commands;

use Bitrix\Main\Config\Configuration;
use Exception;
use Prokl\DbCommands\Utils\Import;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ConfirmationQuestion;

/**
 * Class DbDrop
 * Дроп текущей базы.
 *
 * @since 12.12.2020
 */
class DbDrop extends Command
{
    /**
     * @var QuestionHelper $questionHelper Помощник с вопросами.
     */
    private $questionHelper;

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
        $this->setName('db:drop')
             ->setDescription('Drop current database');
    }

    /**
     * @inheritDoc
     */
    protected function initialize(InputInterface $input, OutputInterface $output) : void
    {
        $this->questionHelper = $this->getHelper('question');

        parent::initialize($input, $output);
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

        $question = new ConfirmationQuestion(
            '    <error>You sure? Current database will be destroyed.</error>' . PHP_EOL
            . '    <info>Overwrite? [Y/n]</info> ',
            true,
            '/^(y|j)/i'
        );

        if (!$this->questionHelper->ask($input, $output, $question)) {
            return 1;
        }

        $importer = new Import(
            $dbHost,
            $dbName,
            $dbLogin,
            $dbPassword
        );

        try {
            $importer->init();
        } catch (Exception $e) {
            $output->writeln(sprintf(
                'Error connect to MySql server %s.',
                $e->getMessage()
            ));
        }

        // Дропинг базы.
        $output->writeln(sprintf(
            'Dropping database %s.',
            $dbName,
        ));

        $importer->dropDatabase($dbName);

        $output->writeln('Dropping database completed.');

        return 0;
    }
}
