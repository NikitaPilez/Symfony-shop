<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Message;
use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/contact", name="message")
     */

    public function contactIndex(Request $request)
    {
        $message = new Message();
        $form = $this->createFormBuilder($message)
            ->add('email', TextType::class)
            ->add('name', TextType::class)
            ->add('message', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Send message'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $message = $form->getData();

             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($message);
             $entityManager->flush();

            return $this->redirectToRoute('message');
        }

        return $this->render('message.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}