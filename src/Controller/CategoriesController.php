<?php


namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Produits;
use App\Form\CategoriesType;
use App\Form\ProduitsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategoriesController extends AbstractController
{
    #[Route('/categories', name: 'app_categories')]
    public function index(ManagerRegistry $doctrine): Response
    {

        $entityManager = $doctrine->getManager();
        $data = $entityManager->getRepository(Categories::class)->findAll();
        return $this->render('categories/index.html.twig', [
            'controller_name' => 'CategoriesController',
            'Categories' => $data,
        ]);
    }

    #[Route('/categories/{id<\d+>}', name: 'app_categories_details')]
    public function get(Categories $categories): Response
    {
        return $this->render('categories/show.html.twig', [
            'controller_name' => 'CategoriesController',
            'Categories' => $categories,
        ]);
    }
    #[Route('/categories/new', name: 'app_categories_new')]
    public function post(Request $request, ManagerRegistry $doctrine): Response
    {
        $categories = new Categories();
        $entityManager = $doctrine->getManager();
        $form = $this->createForm(CategoriesType::class, $categories);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $categories->setUser($this->getUser());
            $entityManager->persist($categories);
            $entityManager->flush();

            return $this->redirectToRoute('app_categories');
        }
        return $this->render('categories/new.html.twig', [
            'controller_name' => 'CategoriesController',
            'categoriesform' => $form->createView()
        ]);
    }

    #[Route('/categories/edit/{id<\d+>}', name: 'app_categories_edit')]
    public function edit(Categories $categories, ManagerRegistry $doctrine, Request $request)
    {
        $form = $this->createForm(CategoriesType::class, $categories);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->flush();
            return $this->redirectToRoute('app_categories');
        }
        return $this->render('categories/edit.html.twig', [
            'controller_name' => 'ProduitsController',
            'categories' => $categories,
            'categoriesform' => $form->createView()
        ]);
    }

    #[Route('/categories/delete/{id<\d+>}', name: 'app_categories_delete')]
    public function deleteAction(Categories $categories, ManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();
        $entityManager->remove($categories);
        $entityManager->flush();
        return $this->redirectToRoute('app_categories');
    }
}
