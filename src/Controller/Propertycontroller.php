<?php
namespace Controller;

use App\Entity\Property;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Propertycontroller extends AbstractController{
    #[Route('/property','propriete')]
    public function index(EntityManagerInterface $entityManager):Response{
        $name=$entityManager->getRepository(Property::class);
         $products=$name->findfloor();
        return $this->render('pages/property.html.twig',[
            'current_menu'=>'propriete'
        ]);
    }
    #[Route('/biens/{slug}-{id}','property.show')]
    public function show($slug,$id,EntityManagerInterface $entityManager):Response{
        $name=$entityManager->getRepository(Property::class);
        $produit=$name->find($id);
        if($slug!== $produit->getSlug()){
            return $this->redirectToRoute('property.show',[
                'id'=>$produit->getId(),
                'slug'=>$produit->getSlug()
            ],301);
        }
        return new Response($this->render('property/show.html.twig',[
            'produit'=>$produit
        ]));
    }
    
}