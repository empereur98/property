<?php
namespace Controller;

use App\Entity\Property;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class Homecontroller extends AbstractController{
    #[Route('/','home')]
    public function index(EntityManagerInterface $entityManager):Response{
       $product= $entityManager->getRepository(Property::class)->findlass();
        return new Response($this->render('pages/home.html.twig',[
            'properties'=> $product
        ]));
    }
    
}