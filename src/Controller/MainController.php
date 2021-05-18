<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name ="main_home")
     */
    public function home()
    {

        return $this->render("main/home.html.twig", []);
       // die("home bucket");
    }

    /**
     * @Route("/aboutus", name =" main_aboutus")
     */
    public function  aboutus()
    {
        return $this->render("main/aboutUs.html.twig");
    }
}