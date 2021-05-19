<?php

namespace App\Controller;

use App\Repository\WishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    /**
     * @Route("/list", name="wish_list")
     */
    public function list( WishRepository  $wishRepository): Response
    {

       // $listeFilm = ["Film" =>"1001 pattes", "roi lion", "v pour vendetta"];
        //return $this->render('wish/list.html.twig', ["liste"=>$listeFilm]);
      //$wishlist=  $wishRepository->findBy([],["dateCreated" => "ASC"],10,0);
        $wishlist = $wishRepository->findBestNotation();
      return  $this->render("wish/list.html.twig",[ "wishList"=>$wishlist]);

    }

    /**
     * @Route("/list/detail/{id}", name="wish_detail")
     */
    public function detail($id, WishRepository  $wishRepository): Response
    {
        $wish = $wishRepository ->find($id);

        if(!$wish)
        {
            throw $this->createNotFoundException(" This wish does not exist !! ");



        }
        return $this->render('wish/detail.html.twig', ["wish"=>$wish]);
    }
}
