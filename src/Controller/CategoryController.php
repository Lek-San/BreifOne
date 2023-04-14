<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * This function display all categories
     *
     * @param CategoryRepository $categoryRepository
     * @param PaginatorInterface $paginatorInterface
     * @param Request $request
     * @return Response
     */
    #[Route('/categories', name: 'app_category', methods: ['GET'])]
    public function index(CategoryRepository $categoryRepository, PaginatorInterface $paginatorInterface, Request $request): Response
    {

        $categories = $paginatorInterface->paginate(
            $categoryRepository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            15, /*limit per page*/
        );

        return $this->render('pages/category/category.html.twig', [
            'categories' => $categories,
        ]);
    }
}
