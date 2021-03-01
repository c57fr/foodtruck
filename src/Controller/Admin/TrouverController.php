<?php

namespace App\Controller\Admin;

use App\Entity\Trouver;
use App\Form\TrouverType;
use App\Repository\TrouverRepository;
use App\Service\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TrouverController extends AbstractController
{
    /**
     * @Route("/admin/trouver", name="admin_trouver")
     */
    public function index(): Response
    {
        return $this->render('admin/trouver/index.html.twig', [
            'controller_name' => 'TrouverController',
        ]);
    }

    

    /**
     * @Route("/admin/trouver", name="admin_trouver")
     */
    public function trouverAll(TrouverRepository $trouverrepository): Response
    {
         $trouver = $trouverrepository->findAll();
        return $this->render('admin/trouver/index.html.twig', [
            'trouver' => $trouver,
        ]);
    }

    /**
     * @Route("/admin/trouver/add", name="admin_trouver_add")
     */
    public function addWithImage(Request $request, FileUploader $file_uploader)
  {

    $trouver = new Trouver ();

    

    $form = $this->createForm(TrouverType::class, $trouver);
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
          // Oups, une erreur est survenue!!!
        }
       
        
      }
      $trouver->setImage($file_name);
      $em = $this->getDoctrine()->getManager();
      $em->persist($trouver);
      $em->flush();

      return $this->redirectToRoute('admin_trouver');
    }
      return $this->render('admin/trouver/add.html.twig', [
      'form' => $form->createView(),
    ]);
  }

    /**
     * @Route("/admin/trouver/edit/{id}", name="admin_trouver_edit", requirements={"id":"\d+"} )
     */

    public function editLoc(Trouver $trouver, Request $request)
    {
        
        $form = $this->createForm(trouverType::class, $trouver);
        $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {
           
           $this->getDoctrine()->getManager()->flush();
           
           return $this->redirectToRoute('admin_trouver');
           
       }

        return $this->render('admin/trouver/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/trouver/delete/{id}", name="admin_trouver_delete"), requirements={"id":"\d+"}, methods={DELETE})
     */

    public function delete(Trouver $trouver)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($trouver);
        $em->flush();

        return $this->redirectToRoute('admin_trouver');
    }

    /**
     * @Route("/front/main/categorie", name="front_main_categorie")
     */
    public function test(): Response
    {
        return $this->render('admin/categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
        ]);
    }

}
