<?php

namespace App\Commands;


use App\Models\User;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SendMailsCommand extends Command
{
    protected static $defaultName = 'app:send-mails';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $postData = [
            'name' => 'Test',
            'mail' => 'mail',
            'message' => 'msg'
        ];
        $transport = (new Swift_SmtpTransport(getenv('SMTP_HOST'), getenv('SMTP_PORT')))
            ->setUsername(getenv('SMTP_USER'))
            ->setPassword(getenv('SMTP_PASS'));

        $mailer = new Swift_Mailer($transport);

        $message = (new Swift_Message('Contact request'))
            ->setFrom(['resume@domain.com' => 'Contact'])
            ->setTo(['yourmail@domain.org'])
            ->setBody('Hi, you have a new contact request from ' . $postData['name']
                . '. Contact: ' . $postData['mail'] . ' with message: ' . $postData['message']
            )
        ;

        $mailer->send($message);
    }
}