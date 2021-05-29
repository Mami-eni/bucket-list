<?php

namespace App\Controller;

use App\Censurator\Censurator;
use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;


class WishController extends AbstractController
{
    /**
     * @Route("/list/{page}", name="wish_list", requirements= {"page"="\d+"})
     */
    public function list(int $page=1, WishRepository  $wishRepository): Response
    {

       // $listeFilm = ["Film" =>"1001 pattes", "roi lion", "v pour vendetta"];
        //return $this->render('wish/list.html.twig', ["liste"=>$listeFilm]);
      //$wishlist=  $wishRepository->findBy([],["dateCreated" => "ASC"],10,0);

        $wishlist = $wishRepository->findBestNotation($page);

      return  $this->render("wish/list.html.twig",[ "wishList"=>$wishlist,"currentPage"=>$page]);

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


    /**
     * @Route("/create", name="wish_create")
     */
    public function create(Request $request, EntityManagerInterface $entityManager, Censurator $censure): Response
    {


        $wish=  new Wish();
        $textToCheck= $wish->getDescription();

        $wish->setAuthor($this->getUser()->getUsername());
        $wishForm = $this->createForm(WishType::class, $wish);
        if(!is_null($textToCheck))
        {
            $newDescription= $censure->purify($textToCheck);
            $wish->setDescription($newDescription);

        }

        $wish->setIsPublished(1);
        $wish->setDateCreated(new \DateTime());
        $wishForm->handleRequest($request);


        // traitement du mot offensant appel methode service.






        if($wishForm->isSubmitted() && $wishForm->isValid())
        {
            $entityManager->persist($wish);
            $entityManager->flush();
            $this->addFlash( "success","Idea successfully added!");

            return $this->redirectToRoute("wish_detail", ["id"=> $wish->getId()]);
        }



        return $this->render("wish/create.html.twig", ["formulaire"=> $wishForm->createView(),"wish"=>$wish ,"author"=>$wish->getAuthor() ]);


    }

    /**
     * @Route("/update/{id}", name="wish_update")
     */
    public function update($id, Request $request, EntityManagerInterface $entityManager, WishRepository  $wishRepository): Response
    {
        $wish= $wishRepository ->find($id);
        $wishForm = $this->createForm(WishType::class, $wish);
        //$wish->setIsPublished(1);
        $wish->setDateCreated(new \DateTime());

        $wishForm->handleRequest($request);

        if($wishForm->isSubmitted() && $wishForm->isValid())
        {
            $entityManager->persist($wish);
            $entityManager->flush();
            $this->addFlash( "success","Idea successfully modified!");

            return $this->redirectToRoute("wish_detail", ["id"=> $wish->getId()]);
        }

        return $this->render("wish/update.html.twig", ["formulaire"=> $wishForm->createView(), 'wish'=>$wish]);



    }


}
