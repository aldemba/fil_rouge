<?php

namespace App\Services;

use Twig\Environment;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;


class MailerService 
{
    public function __construct(MailerInterface $mailer, Environment $twig)
    {
        $this->mailer=$mailer;
        $this->twig=$twig;
    }
    public function sendEmail($user, $objet='Creation de compte') 
    {
         $email = (new Email()) 
         ->from('aldemba@gmail.com') 
         ->to($user->getLogin()) 
         ->subject($objet)
         ->html($this->twig->render("mail/index.html.twig", [
             "user"=>$user
         ])); 

         $this->mailer->send($email);

}

}
