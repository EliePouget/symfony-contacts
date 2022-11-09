<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $qb = $categoryRepository->createQueryBuilder('c')
            ->select(['c as category'])
            ->addSelect('COUNT(co) as count')
            ->leftJoin('c.contacts', 'co')
            ->orderBy('c.name', 'ASC')
            ->groupBy('c');
        return $this->render('category/index.html.twig', [
            'listCategory' => $categories,
        ]);
    }
    #[Route('/category/{id}', name: 'app_category_show')]
    public function show(Category $category): Response
    {
        return $this->render('category/show.html.twig', ['category'=> $category]);
    }
}
