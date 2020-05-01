<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{

    /**
    * @Route("/")
    */

    public function index()
    {
        $number = random_int(0, 100);

        return $this->render('base.html.twig', [
            'number' => $number,
        ]);
    }

    /**
     * @Route("/category/{categoryName}", methods="GET",  requirements={"categoryName"="\d+"})
     */

    public function categoryIndex()
    {

    }

    /**
     * @Route("/product/{productName}", methods="GET",  requirements={"productName"="\d+"})
     */

    public function productIndex()
    {

    }

    /**
     * @Route("/contact", methods="GET")
     */

    public function contactIndex()
    {

    }
}