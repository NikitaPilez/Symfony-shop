<?php

namespace App\Controller;

use App\Entity\Product;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShopController extends AbstractController
{

    /**
    * @Route("/")
    */

    public function index()
    {
        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findAll();

        return $this->render('base.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/category/{categoryId}", methods="GET",  requirements={"categoryId"="\d+"}, name="category")
     * @param $categoryId
     */

    public function categoryIndex($categoryId)
    {

    }

    /**
     * @Route("/product/{productId}", methods="GET",  requirements={"productId"="\d+"}, name="product")
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