<?php

namespace App\Controller\Admin;

use App\Entity\Users;
use App\Form\UsersType;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UsersController extends AbstractController
{
    /**
     * @Route("/admin/users", name="admin_users")
     */
    public function users(UsersRepository $users): Response
    {
        return $this->render('admin/users/index.html.twig', [
            'users' => $users->findAll(),
        ]);
    }
    
    /**
     * @Route("/admin/users/edit/{id}", name="admin_users_edit" , requirements={"id":"\d+"})
     */
    public function editUsers(Users $users, Request $request,UserPasswordEncoderInterface $userPasswordEncoder): Response
    {

        $form = $this->createForm(UsersType::class, $users);
        $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {
         
        // On récupère le mot de passe
            // Dans l'objet $form, on demande le champs «password» et on demande la donnée reçue dans ce champs
            $password = $form->get('password')->getData();

            // Il est impossible de comparer directement le mot de passe reçu avec la valeur en BDD
            // Donc, si $password n'est pas null, on le met à jour dans l'objet $user
            if ($password != null) {
                // On utilise $userPasswordEncoder pour hasher le mot de passe
                $encodedPassword = $userPasswordEncoder->encodePassword($users, $password);
                $users->setPassword($encodedPassword);

                // On peut le faire en une seule ligne :
                // $user->setPassword($userPasswordEncoder->encodePassword($user, $password));
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_users');
        }

           
       

        return $this->render('admin/users/edit.html.twig', [
            'users'=> $users,
            'form' => $form->createView(),
        ]);
    }

}
