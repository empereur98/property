<?php
namespace Controller\Admin;

use App\Entity\Options;
use App\Form\OptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OptionController extends AbstractController{
    public $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em=$em;
    }
    #[Route('admin/option','option')]
    public function index():Response{
        $option=$this->em->getRepository(Options::class)->findAll();
        return new Response($this->render('option/admin.html.twig',[
            'option'=>$option,
            'current_name'=>'option'
        ]));
    }
    #[Route('admin/option/edit/{id}','edit_option')]
    public function edit(Request $request,Options $option):Response{
        $form=$this->createForm(OptionType::class,$option);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->flush();
            $this->addFlash('success','l\'option a bel et bien ete modifier');
            return $this->redirectToRoute('option');
        }
        return new Response($this->render('option/edit.html.twig',[
            'form'=>$form->createView(),
            'current_name'=>'edit'
        ]));
    }
    #[Route('admin/option/new','new_option')]
    public function new(Request $request):Response{
        $option=new Options();
        $form=$this->createForm(OptionType::class,$option);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($option);
            $this->em->flush();
            $this->addFlash('success','l\'option est enregistrer');
            return $this->redirectToRoute('option');
        }
        return new Response($this->render('option/new.html.twig',[
            'form'=>$form->createView(),
        ]));
    }
    #[Route('admin\option\delete\{id}','delete_option',methods:'DELETE')]
    public function delete(Options $option):Response{
        $produit=$this->em->getRepository(Options::class);
        $produit->remove($option);
        if($this->em->flush()){
            return $this->redirectToRoute('option');
        }
        return new Response($this->render('option/delete.html.twig',[
            'current_name'=>'delete',
            'option'=>$option
        ]));
    }
}