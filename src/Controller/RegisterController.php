<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;



class RegisterController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function index(UserPasswordHasherInterface $passwordHasher,ManagerRegistry $doctrine,Request $request): Response
    {
        $entityManager = $doctrine->getManager();
        $form =$this->createForm(UserType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $user = new User();
            $plaintextPassword = $request->request->all('user')['password']['first'];
            $user->setEmail($request->request->all('user')['email']);
            $user->setUsername($request->request->all('user')['username']);
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $plaintextPassword
            );
            $user->setPassword($hashedPassword);
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('app_login');


        }
        return $this->render('register/index.html.twig', [
            'controller_name' => 'RegisterController',
            'userform' => $form->createView()
        ]);
    }
}
