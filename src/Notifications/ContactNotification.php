<?php
namespace App\Notifications;

use App\Entity\Contact;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Routing\Annotation\Route;


 class ContactNotification{
   #[Route('/biens/{slug}-{id}','property.show')]
    public function notify(MailerInterface $mailer,Contact $contact){
      $email = (new TemplatedEmail())
      ->from('hello@example.com')
      ->to($contact->getEmail())
      //->cc('cc@example.com')
      //->bcc('bcc@example.com')
      //->replyTo('fabien@example.com')
      //->priority(Email::PRIORITY_HIGH)
      ->subject('Agence!'.$contact->getProperty()->getTitle())
      ->text($contact->getMessages())
      ->html('<p>See Twig integration for better HTML integration!</p>')
      ->htmlTemplate('emails/signup.html.twig')
      ->context([
          'expiration_date' => new \DateTime('+7 days'),
          'username' => 'franck rodrigue',
          'contact' => $contact,
      ]);
      $mailer->send($email);
    }
 }