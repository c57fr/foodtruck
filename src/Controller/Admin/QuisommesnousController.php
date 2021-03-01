<?php

namespace App\Controller\Admin;


use App\Entity\Quisommesnous;
use App\Form\QuisommesnousType;
use App\Repository\QuisommesnousRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\FileUploader;

class QuisommesnousController extends AbstractController
{
    /**
     * @Route("/admin/quisommesnous", name="admin_quisommesnous")
     */
    public function index(): Response
    {
        return $this->render('front/quisommesnous/index.html.twig', [
            'controller_name' => 'QuisommesnousController',
        ]);
    }

    
    /**
     * @Route("/front/main/quisommesnous", name="front_main_qui_sommes_nous")
     */
    public function quiSommesNous(QuisommesnousRepository $quisommesnousrepository): Response
    {
         $quisommesnous = $quisommesnousrepository->findAll();
        return $this->render('front/main/qui_sommes_nous.html.twig', [
            'quisommesnous' => $quisommesnous,
        ]);
    }

    /**
     * @Route("/admin/quisommesnous", name="admin_quisommesnous")
     */
    public function viewAll(QuisommesnousRepository $quisommesnousrepository): Response
    {
         $quisommesnous = $quisommesnousrepository->findAll();
        return $this->render('admin/quisommesnous/index.html.twig', [
            'quisommesnous' => $quisommesnous,
        ]);
    }

    /**
     * @Route("/admin/quisommesnous/add", name="admin_quisommesnous_add")
     */
    public function addQuiSommesnousWithImage(Request $request, FileUploader $file_uploader)
  {

    $quisommesnous = new Quisommesnous ();

    

    $form = $this->createForm(QuisommesnousType::class, $quisommesnous);
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
      $quisommesnous->setImage($file_name);
      $em = $this->getDoctrine()->getManager();
      $em->persist($quisommesnous);
      $em->flush();

      return $this->redirectToRoute('admin_quisommesnous');
    }
      return $this->render('admin/quisommesnous/add.html.twig', [
      'form' => $form->createView(),
    ]);
  }

    /**
     * @Route("/admin/quisommesnous/edit/{id}", name="admin_quisommesnous_edit", requirements={"id":"\d+"} )
     */

    public function editProduct(Quisommesnous $quisommesnous, Request $request)
    {
        
        $form = $this->createForm(QuisommesnousType::class, $quisommesnous);
        $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()) {
           
           $this->getDoctrine()->getManager()->flush();
           
           return $this->redirectToRoute('admin_quisommesnous');
           
       }

        return $this->render('admin/quisommesnous/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    

    /**
     * @Route("/admin/quisommesnous/delete/{id}", name="admin_quisommesnous_delete"), requirements={"id":"\d+"}, methods={DELETE})
     */

    public function deleteProduct(Quisommesnous $produit)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($produit);
        $em->flush();

        return $this->redirectToRoute('admin_quisommesnous');
    }

}
