<?php
namespace App\Controllers;

use App\Models\User;
use Respect\Validation\Validator as v;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;
use Zend\Diactoros\Response\RedirectResponse;

class ContactController extends BaseController {
    public function indexAction() {
        return $this->renderHTML('contact/index.twig');
    }

    public function sendAction($request) {
        $postData = $request->getParsedBody();
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

        $result = $mailer->send($message);


        return new RedirectResponse('/contact');
    }
}