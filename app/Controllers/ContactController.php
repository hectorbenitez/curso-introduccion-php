<?php
namespace App\Controllers;

use App\Models\Message;
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

        $message = new Message();
        $message->name = $postData['name'];
        $message->mail = $postData['mail'];
        $message->message = $postData['message'];
        $message->email_sent = false;
        $message->save();

        return new RedirectResponse('/contact');
    }
}