<?php
namespace Controller;

use App\Entity\Property;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class Homecontroller extends AbstractController{
    #[Route('/','home')]
    public function index(EntityManagerInterface $entityManager,UserPasswordHasherInterface $passwordHasher):Response{
       /* $user=new User();
        $user->setEmail("franckrodrigue98@gmail.com");
        $user->setPassword("demo");
        $user->setRoles(['ROLE_ADMIN']);
        $plainttextWord="demo";
        $hashpassword=$passwordHasher->hashPassword($user,$plainttextWord);
        $user->setPassword($hashpassword);
        $entityManager->persist($user);
        $entityManager->flush();*/
        $produits= $entityManager->getRepository(Property::class)->findlass();
        return new Response($this->render('pages/home.html.twig',[
            'properties'=>$produits
        ]));
    }
    
}