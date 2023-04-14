<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * This function display all products
     *
     * @param ProductRepository $productRepository
     * @param PaginatorInterface $paginatorInteface
     * @param Request $request
     * @return Response
     */
    #[Route('/products', name: 'app_product', methods: ['GET'])]
    public function index(ProductRepository $productRepository, PaginatorInterface $paginatorInteface, Request $request): Response
    {
        $products = $paginatorInteface->paginate(
            $productRepository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            3 /*limit per page*/
        );

        return $this->render('pages/product/product.html.twig', [
            'products' => $products,
        ]);
    }
}
