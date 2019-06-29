<?php

namespace App\Commands;


use App\Models\Message;
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
        $pendingMessage = Message::where('email_sent', false)->first();
        if( $pendingMessage) {
            $transport = (new Swift_SmtpTransport(getenv('SMTP_HOST'), getenv('SMTP_PORT')))
                ->setUsername(getenv('SMTP_USER'))
                ->setPassword(getenv('SMTP_PASS'));

            $mailer = new Swift_Mailer($transport);

            $message = (new Swift_Message('Contact request'))
                ->setFrom(['resume@domain.com' => 'Contact'])
                ->setTo(['yourmail@domain.org'])
                ->setBody('Hi, you have a new contact request from ' . $pendingMessage->name
                    . '. Contact: ' . $pendingMessage->mail . ' with message: ' . $pendingMessage->message
                )
            ;

            $mailer->send($message);
            $pendingMessage->email_sent = true;
            $pendingMessage->save();
        }
        return true;
    }
}