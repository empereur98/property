<?php
namespace Controller\Security;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class Securitycontroller extends AbstractController
{
   #[Route('/login','app_login')]
   public function login(AuthenticationUtils $authentification):Response{
    $error=$authentification->getLastAuthenticationError();
    $lastusername=$authentification->getLastUsername();
    return $this->render('pages/login.html.twig',[
        'controller_name'=>'Securitycontroller',
        'lastname'=>$lastusername,
        'error'=>$error
    ]);
   }
}