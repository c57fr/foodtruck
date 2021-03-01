<?php

namespace App\Controller\Admin;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{
    /**
     * @Route("/admin/categorie", name="admin_categorie")
     */
    public function index(): Response
    {
        return $this->render('admin/categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
        ]);
    }

    /**
     * @Route("/admin/categorie", name="admin_categorie")
     */
    public function viewAll(CategorieRepository $categorierepository): Response
    {
         $categorie = $categorierepository->findAll();
        return $this->render('admin/categorie/index.html.twig', [
            'categorie' => $categorie,
        ]);
    }

    /**
     * @Route("/admin/categorie/add", name="admin_categorie_add")
     */
    public function add(Request $request): Response
    {
        
        $categorie = new Categorie();

        
        $form = $this->createForm(CategorieType::class, $categorie);

        
        $form->handleRequest($request);

       // Une fois la requête reliée, si formulaire a détecté tous ses champs,
       // il est capable de nous dire si le formulaire est envoyé et si les données reçues sont valides
       // (attention, on parlera de validation plus tard)
       // isValid() nous permet de confirmer si le token CSRF est valide !)
       if ($form->isSubmitted() && $form->isValid()) {
           // On peut persister notre objet en BDD
           $em = $this->getDoctrine()->getManager();
           $em->persist($categorie);
           $em->flush();

           return $this->redirectToRoute('admin_categorie');
           // Ici on pourrait rediriger vers la liste des messages
       }

        return $this->render('admin/categorie/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/categorie/edit/{id}", name="admin_categorie_edit", requirements={"id":"\d+"} )
     */

    public function editCategorie(Categorie $categorie, Request $request)
    {
        
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {
           
           $this->getDoctrine()->getManager()->flush();
           
           return $this->redirectToRoute('admin_categorie');
           
       }

        return $this->render('admin/categorie/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    

    /**
     * @Route("/admin/produit/categorie", name="admin_produit_categorie")
     */
    public function Adminproduct(CategorieRepository $categorierepository): Response
    {
        $categorie = $categorierepository->findAll();
        return $this->render('admin/produit/produit.html.twig', [
            'categorie' => $categorie,
        ]);
    }

    /**
     * @Route("/admin/categorie/detail/{id}", name="admin_categorie_detail", requirements={"id": "\d+"})
     */
    public function adminCategorieDetail(int $id,CategorieRepository $categorieRepository,ProduitRepository $produitRepository): Response
    {
      $categorie =$categorieRepository->findAll();
      $produit = $produitRepository->findCategorieProduit($id);

      return $this->render('admin/produit/detail.html.twig', [
          'controller_name' => 'CategorieController',
          'categorie'=> $categorie,
          'produit'=> $produit,
      ]);
   }
    

    /**
     * @Route("/admin/categorie/delete/{id}", name="admin_categorie_delete"), requirements={"id":"\d+"}, methods={DELETE})
     */

    public function deleteCategorie(Categorie $categorie)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($categorie);
        $em->flush();

        return $this->redirectToRoute('admin_categorie');
    }

    /**
     * @Route("/front/main/categorie", name="front_main_categorie")
     */
    public function test(): Response
    {
        return $this->render('front/main/produit.html.twig', [
            'controller_name' => 'CategorieController',
        ]);
    }
    
    

    /**
     * @Route("/front/main/categ/{id}", name="front_main_categ", requirements={"id": "\d+"})
     */
   public function categorieDetail(int $id,CategorieRepository $categorieRepository,ProduitRepository $produitRepository): Response
    {
      $categorie =$categorieRepository->findAll();
      $produit = $produitRepository->findCategorieProduit($id);

      return $this->render('front/main/detail.html.twig', [
          'controller_name' => 'CategorieController',
          'categorie'=> $categorie,
          'produit'=> $produit,
      ]);
   }

   
   
}
