<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
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
    #[Route('/products', name: 'app_products', methods: ['GET'])]
    public function index(
        ProductRepository $productRepository,
        PaginatorInterface $paginatorInteface,
        Request $request
    ): Response
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

    /** This function creates a product
     *
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/product/newProduct', name: 'app_new_product', methods: ['GET', 'POST'])]
    public function newProduct(
        Request $request,
        EntityManagerInterface $manager
    ): Response
        {
            $product = new Product();
            $form = $this->createForm(ProductType::class, $product);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $product = $form->getData();

                $manager->persist($product);
                $manager->flush();

                $this->addFlash(
                    'success',
                    'Vous venez d\'ajouter un nouveau produit avec succès !!!'
                );

                return $this->redirectToRoute('app_products');
            }



            return $this->render('pages/product/newProduct.html.twig', [
                'form' => $form->createView()
            ]);
        }
}
