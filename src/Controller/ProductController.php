<?php

namespace App\Controller;

use App\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class ProductController extends AbstractController
{
    /**
     * @Route("/product/create", name="product_create")
     */
    public function create(Request $request)
    {
        $procust = new Product();
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Ajouter le produit en BDD
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($product);

            $entityManager->flush();


        }


        return $this->render('product/create',[
            'form'=> $form->createView()
        ]);
    }
}
