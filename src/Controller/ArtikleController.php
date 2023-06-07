<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\Entity;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArtikleController extends AbstractController
{

    #[Route('/artikle', name: 'app_artikle',methods: ['GET'])]
    public function index(ArticleRepository $repository,PaginatorInterface $paginator, Request $request): Response
    {
        $articles = $paginator->paginate(
            $repository->findAll(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            12 /*limit per page*/
        );


        return $this->render('artikle/index.html.twig', [
            'articles' =>$articles
        ]);
    }

    #[Route('/artikle/nouveau','article.new',methods: ['GET','POST'])]
    public function new(Request $request,EntityManagerInterface $manager)
    : Response{
        $article = new Article();
        $form = $this->createForm(ArticleType::class,$article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $article =$form->getData();
            $manager->persist($article);
            $manager->flush();
            $this->addFlash(
                'sucess',
                "La création de l'article a été effectuée !"
            );
            return $this->redirectToRoute('app_artikle');
        }


        return $this->render('artikle/new.html.twig',[
            'form' => $form->createView()
        ]);
    }
    #[Route('article/edition/{id}','article.edit',methods: ['GET','POST'])]
    public function edit (ArticleRepository
    $repository, int $id) : Response
    {
        $article = $repository->findOneBy(["id"=>$id]);
        $form = $this->createForm(ArticleType::class,$article);

        return $this->render('artikle/edit.html.twig');
    }



}
