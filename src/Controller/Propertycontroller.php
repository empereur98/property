<?php
namespace Controller;
use App\Entity\Contact;
use App\Entity\Property;
use App\Entity\Searchdata;
use App\Form\SearchType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;
use Symfony\Contracts\Translation\TranslatorInterface;
use App\Notifications\ContactNotification;
use Symfony\Component\Mailer\MailerInterface;
class Propertycontroller extends AbstractController{
    #[Route('/property','propriete')]
    public function index(EntityManagerInterface $entityManager):Response{
         $produits=$entityManager->getRepository(Property::class)->findAll();
        return $this->render('pages/property.html.twig',[
            'current_menu'=>'propriete',
            'properties'=>$produits
        ]);
    }
    #[Route('/biens/{slug}-{id}','property.show')]
    public function show($slug,$id,EntityManagerInterface $entityManager,Request $request,MailerInterface $mailer):Response{
        $contact=new Contact();
        $name=$entityManager->getRepository(Property::class);
        $produit=$name->find($id);
        if($slug!== $produit->getSlug()){
            return $this->redirectToRoute('property.show',[
                'id'=>$produit->getId(),
                'slug'=>$produit->getSlug()
            ],301);
        }
        $contact->setProperty($produit);
        $form=$this->createForm(ContactType::class,$contact);
        $form->handleRequest($request);
        $notification=new ContactNotification();
        if($form->isSubmitted() && $form->isValid()){
            $notification->notify($mailer,$contact);
            $this->addFlash('success','votre Email a bien ete envoye');
            return $this->redirectToRoute('property.show',[
                'id'=>$produit->getId(),
                'slug'=>$produit->getSlug()
            ]);
        }
       
        return new Response($this->render('property/show.html.twig',[
            'produit'=>$produit,
            'form'=>$form->createView()
        ]));
    }
    /**
     * @return Response
     */
    #[Route('/property','propriete')]
    public function paginate(PaginatorInterface $paginator, Request $request,EntityManagerInterface $em){
        $search=new Searchdata();
        $form=$this->createForm(SearchType::class,$search); 
        $form->handleRequest($request);
        $search=$form->getData();
        $query=$em->getRepository(Property::class)->price($search);
    $pagination = $paginator->paginate(
        $query, /* query NOT result */
        $request->query->getInt('page', 1), /*page number*/
        10); /*limit per page*/
    //$pagination->setTemplate('my_pagination.html.twig');
        $page=$request->query->getInt('page',1);
        //$pagination->setTemplate('my_pagination.html.twig');
        dump($pagination);
        return new Response($this->render('pages/property.html.twig',[
           'pagination'=>$pagination,
           'form'=>$form->createView()
        ]));
}
}