<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ProductRepository $repository)
    {
        // comment recuperer les produits les plus chers ?
        //$repository-> findBy(['price' => 645500]);
        $products = $repository->findMoreExpensive();

        return $this->render('home/index.html.twig');
    }
}
