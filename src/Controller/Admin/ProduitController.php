<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProduitController extends AbstractController
{
    /**
     * @Route("/admin/produit", name="admin_produit")
     */
    public function index(): Response
    {
        return $this->render('admin/produit/index.html.twig', [
            'controller_name' => 'ProduitController',
        ]);
    }

    /**
     * @Route("/admin/produit", name="admin_produit")
     */
    public function viewAll(ProduitRepository $produitrepository): Response
    {
         $produit = $produitrepository->findAll();
        return $this->render('admin/produit/index.html.twig', [
            'produit' => $produit,
        ]);
    }

    /**
     * @Route("/admin/produit/add", name="admin_produit_add")
     */
    public function addProductWithImage(Request $request, FileUploader $file_uploader)
  {

    $produit = new Produit ();

    

    $form = $this->createForm(ProduitType::class, $produit);
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) 
    {
      $file = $form['image']->getData();
      if ($file) 
      {
        $file_name = $file_uploader->upload($file);
        if (null !== $file_name) // for example
        {
          $directory = $file_uploader->getTargetDirectory();
          $full_path = $directory.'/'.$file_name;
          // Do what you want with the full path file...
          // Why not read the content or parse it !!!
        }
        else
        {
          // Oups, an error occured !!!
        }
       
        
      }
      $produit->setImage($file_name);
      $em = $this->getDoctrine()->getManager();
      $em->persist($produit);
      $em->flush();

      return $this->redirectToRoute('admin_produit');
    }
      return $this->render('admin/produit/add.html.twig', [
      'form' => $form->createView(),
    ]);
  }

    /**
     * @Route("/admin/produit/edit/{id}", name="admin_produit_edit", requirements={"id":"\d+"} )
     */

    public function editProduct(Produit $produit, Request $request)
    {
        
        $form = $this->createForm(ProduitType::class, $produit);
        $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {
           
           $this->getDoctrine()->getManager()->flush();
           
           return $this->redirectToRoute('admin_produit');
           
       }

        return $this->render('admin/produit/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    

    /**
     * @Route("/admin/produit/delete/{id}", name="admin_produit_delete"), requirements={"id":"\d+"}, methods={DELETE})
     */

    public function deleteProduct(Produit $produit)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($produit);
        $em->flush();

        return $this->redirectToRoute('admin_produit');
    }


}
