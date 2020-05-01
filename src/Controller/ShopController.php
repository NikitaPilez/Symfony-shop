<?php

namespace App\Controller;

use App\Entity\Category;
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

        return $this->render('main.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @Route("/category/{categoryId}", methods="GET",  requirements={"categoryId"="\d+"}, name="category")
     * @param $categoryId
     */

    public function categoryIndex($categoryId)
    {
        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->find($categoryId);
        $products = $this->getDoctrine()
            ->getRepository(Product::class)
            ->findByCategory($categoryId);

        return $this->render('category.html.twig', [
            'products' => $products,
            'category' => $category,
        ]);
    }

    /**
     * @Route("/product/{productId}", methods="GET",  requirements={"productId"="\d+"}, name="product")
     * @param $productId
     * @return Response
     */

    public function productIndex($productId)
    {
        $product = $this->getDoctrine()
            ->getRepository(Product::class)
            ->find($productId);

        return $this->render('product.html.twig', [
            'product' => $product,
        ]);
    }

    /**
     * @Route("/contact", methods="GET")
     */

    public function contactIndex()
    {

    }
}