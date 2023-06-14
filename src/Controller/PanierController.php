<?php

namespace App\Controller;

use App\Entity\Panier;
use App\Repository\PanierRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'app_panier',methods: ['GET'])]
    public function index(PaginatorInterface $paginator, PanierRepository $repository, Request $request): Response
    {
        $paniers = $paginator->paginate(
            $repository->findAll(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            12 /*limit per page*/);


        return $this->render('panier/index.html.twig', [
            'paniers' => $paniers,


        ]);
    }


    #[Route('/artikle/nouveau','article.new',methods: ['GET','POST'])]
    public function new(Request $request,EntityManagerInterface $manager)
    : Response{


        $article = new Panier();
        $form = $this->createForm(PanierType::class,$article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $article =$form->getData();
            $manager->persist($article);
            $manager->flush();
            $this->addFlash(
                'sucess',
                "La création du panier a été effectuée !"
            );
            return $this->redirectToRoute('app_panier');
        }


        return $this->render('panier/new.html.twig',[
            'form' => $form->createView()
        ]);
    }

    #[Route('panier/suppression/{id}','panier.delete',methods: ['GET'])]
    public function delete(EntityManagerInterface $manager,int $id,PanierRepository $repository) : Response
    {

        $this->denyAccessUnlessGranted('ROLE_USER');

        $panier = $repository->findOneBy(["id"=>$id]);
        if (!$panier){
            $this->addFlash(
                'success',"Le panier n'existe pas !"
            );
        }

        $manager->remove($panier);
        $manager->flush();

        return $this->redirectToRoute('app_panier');
    }

}
