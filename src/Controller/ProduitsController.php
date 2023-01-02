<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Produits;
use App\Form\ProduitsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;



class ProduitsController extends AbstractController
{
    
    public function __construct(private ManagerRegistry $entityManager)
    {

    }
    #[Route('/produits', name: 'app_produits')]
    public function index(): Response
    {
        $data = $this->entityManager->getRepository(Produits::class)->findAll();
        return $this->render('produits/index.html.twig', [
            'controller_name' => 'ProduitsController',
            'Produits' => $data,
        ]);
    }

    #[Route('/produits/{id<\d+>}', name: 'app_produits_details')]
    public function get(Produits $produit): Response
    {
        return $this->render('produits/show.html.twig', [
            'controller_name' => 'ProduitsController',
            'Produit' => $produit,
        ]);
    }
    #[Route('/produits/new', name: 'app_produits_new')]
    public function post(Request $request, SluggerInterface $slugger): Response
    {
        $produit = new Produits();
        $em = $this->entityManager->getManager();
        $form = $this->createForm(ProduitsType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $brochureFile = $request->files->get('ImageFile');
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $brochureFile->guessExtension();

                try {
                    $brochureFile->move(
                        $this->getParameter('brochures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    echo $e;
                }
            }
            $chm = "build/images/" . $newFilename;
            $produit->setImage($chm);
            $produit->setUser($this->getUser());
            $em->persist($produit);
            $em->flush();

            return $this->redirectToRoute('app_produits');
        }
        return $this->render('produits/new.html.twig', [
            'controller_name' => 'ProduitsController',
            'produitform' => $form->createView()
        ]);
    }

    #[Route('/produits/edit/{id}', name: 'app_produits_edit')]
    public function edit(Produits $produit, Request $request, SluggerInterface $slugger)
    {
        $form = $this->createForm(ProduitsType::class, $produit);
        $form->handleRequest($request);        
        if ($form->isSubmitted() && $form->isValid()) {
            $em =$this->entityManager->getManager();
            $brochureFile = $request->files->get('ImageFile');
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $brochureFile->guessExtension();

                try {
                    $brochureFile->move(
                        $this->getParameter('brochures_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    echo $e;
                }
                $chm = "build/images/" . $newFilename;
                $produit->setImage($chm);
            }

            $em->flush();
            return $this->redirectToRoute('app_produits');
        }



        return $this->render('produits/edit.html.twig', [
            'controller_name' => 'ProduitsController',
            'produit' => $produit,
            'produitform' => $form->createView()
        ]);
    }

    #[Route('/produits/delete/{id}', name: 'app_produits_delete')]
    public function deleteAction(Produits $produit)
    {
        $em = $this->entityManager->getManager();
        $em->remove($produit);
        $em->flush();

        return $this->redirectToRoute('app_produits');
    }
}
