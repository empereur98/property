<?php
namespace Controller\Admin;
<<<<<<< HEAD
 
=======

>>>>>>> parent of 7c806a8 (ajout de l'image des propriete:etape 1(ajout seulement des 2 premieres propriete ))
use App\Entity\Property;
use App\Form\FormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
<<<<<<< HEAD
 
=======
>>>>>>> parent of 7c806a8 (ajout de l'image des propriete:etape 1(ajout seulement des 2 premieres propriete ))

class Admincontroller extends AbstractController
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em=$em;
    }
    #[Route('/admin','admin')]
    public function index():Response{
        $local=$this->em->getRepository(Property::class);
        $produits=$local->findAll();
        return new Response($this->render('pages/admin.html.twig',[
            'produits'=>$produits,
            'current_name'=>'admin'
        ]));
    }
    /**
     * return Response
     */
    #[Route('/admin/edit/{id}','edit',methods:'GET|POST')]
    public function edit(Property $property,Request $request,EntityManagerInterface $em):Response{
       $form=$this->createForm(FormType::class,$property);
       $form->handleRequest($request);
       if($form->isSubmitted() && $form->isValid()){
          $em->flush();
          $this->addFlash('success','bien modifier avec success');
          return $this->redirectToRoute('admin');
       }
return new Response($this->render('pages/edit.html.twig',[
    'current_name'=>'edit',
    'form'=>$form->createView()
]));
    }
    #[Route('/admin/new','ajouter')]
    public function new(Request $request,EntityManagerInterface $em):Response{
        $property=new Property();
        $form=$this->createForm(FormType::class,$property);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
           $em->persist($property);
           $em->flush();
          $this->addFlash('success','bien creer avec success');
           return $this->redirectToRoute('admin');
        }
       return new Response($this->render('pages/new.html.twig',[
        'property'=>$property,
        'form'=>$form->createView(),
    ]));
        }
       #[Route('/admin/delete/{id}',name:'delete',methods:'DELETE')]
        public function delete(Property $property): Response
        {
          $local=$this->em->getRepository(Property::class);
          $local->delete($property);
          $this->addFlash('success','bien supprimer avec succes');
           return $this->redirectToRoute('admin');
           return new Response($this->render('pages/admin.html.twig',[
            'property'=>$property
        ]));
        }
}
