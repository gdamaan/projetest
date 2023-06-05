<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtikleController extends AbstractController
{

    #[Route('/artikle', name: 'app_artikle',methods: ['GET'])]
    public function index(ArticleRepository $repository,PaginatorInterface $paginator, Request $request): Response
    {
        $articles = $paginator->paginate(
            $repository->findAll(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );


        return $this->render('artikle/index.html.twig', [
            'articles' =>$articles
        ]);
    }
}
