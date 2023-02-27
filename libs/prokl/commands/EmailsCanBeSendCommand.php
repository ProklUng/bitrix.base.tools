<?php

namespace Prokl\Commands;

use CSiteCheckerTest;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class EmailsCanBeSendCommand
 *
 * @package Prokl\Commands
 *
 * @since 27.08.2021
 */
class EmailsCanBeSendCommand extends Command
{
    /**
     * @inheritDoc
     */
    public function configure()
    {
        $this->setName('bitrix:check-send-email')
             ->setDescription('Check mail sending');
    }

    /**
     * @inheritDoc
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Testing capability of email sending started...');

        $siteChecker = new CSiteCheckerTest;
        if (!$siteChecker->check_mail()) {
            $output->writeln('Sending email failed.');
        }

        if (!$siteChecker->check_mail_big()) {
            $output->writeln('Sending big email failed.');
        }

        $result = $this->runCheck($output);
        if ($result) {
            $output->writeln('Testing sending of email finished successfully.');
        } else {
            $output->writeln('Testing sending of email failed.');
        }

        return 0;
    }

    /**
     * @param OutputInterface $output
     *
     * @return bool
     */
    private function runCheck(OutputInterface $output) : bool
    {
        $defaultMailResult = false;
        $largeMailResult = false;
        if (function_exists('mail')) {
            $emailTo = 'hosting_test@bitrixsoft.com';
            $subject = 'testing mail server';
            $message = 'testing mail server';
            $headers = 'From: webmaster@example.com' . "\r\n" .
                'Reply-To: webmaster@example.com' . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

            $defaultMailResult = mail($emailTo, $subject, $message, $headers);
            if (!$defaultMailResult) {
                $output->writeln('Mail server not configured.');
            }

            $largeMailResult = (new CSiteCheckerTest)->check_mail_big();
            if (!$largeMailResult) {
                $output->writeln('Sending big email failed');
            }
        }

        return $defaultMailResult && $largeMailResult;
    }
}
