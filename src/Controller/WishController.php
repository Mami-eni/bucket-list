<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    /**
     * @Route("/list", name="wish_list")
     */
    public function list(): Response
    {
        $listeFilm = ["Film" =>"1001 pattes", "roi lion", "v pour vendetta"];
        return $this->render('wish/list.html.twig', ["liste"=>$listeFilm]);
    }

    /**
     * @Route("/list/detail{$id}", name="wish_detail")
     */
    public function detail($id): Response
    {
        return $this->render('wish/detail.html.twig', [

        ]);
    }
}
