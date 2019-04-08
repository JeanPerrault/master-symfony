<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/product/create", name="product_create")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Product::class);
        $products = $repository->findAll();

        dump($products);

        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Ajouter le produit en BDD
            $manager = $this->getDoctrine()->getManager();

            $manager->persist($product);
            $manager->flush();
        }

        return $this->render('product/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Créer la route /product où on affichera tous les produits de la base de données.
     * On utilisera les cards de Bootstrap.
     *
     * @Route("/product/list", name="product_list")
     * @param ProductRepository $repository
     * @return Response
     */
    public function list(ProductRepository $repository)
    {
        $products = $repository->findAll();

        return $this->render('product/list.html.twig', [
            'products' => $products
        ]);
    }

    

    /**
     * @Route("/product/{id}", name="product_show")
     * @param $id
     * @param ProductRepository, $repository
     * @return Response
     */
    public function show($id, ProductRepository $repository)
    {
        /*$product = $this->getDoctrine()->getRepository(Product::class)->find($id);*/
        $product = $repository->find($id);

        if(!$product){
            throw $this->createNotFoundException(
                'Le produit '.$id.' n\'existe pas'
            );        }

        return $this->render('product/show.html.twig',[
            'product'=> $product
        ]);
    }

}
