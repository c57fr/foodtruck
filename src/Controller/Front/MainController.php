<?php

namespace App\Controller\Front;

use App\Form\ContactType;
use App\Repository\CategorieRepository;
use App\Repository\ProduitRepository;
use App\Repository\TrouverRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/front/main", name="front_main")
     */
    public function index(): Response
    {
        return $this->render('front/main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }


    /**
     * @Route("/front/main/produit", name="front_main_produit")
     */
    public function product(CategorieRepository $categorierepository , ProduitRepository $produitrepository): Response
    {
        $categorie = $categorierepository->findAll();
        $produit = $produitrepository-> findAll();
        return $this->render('front/main/produit.html.twig', [
            'categorie' => $categorie,
            'produit' => $produit,
        ]);
    }
    

    /**
     * @Route("/front/main/produit", name="front_main_produit")
     */
    public function newproduct(ProduitRepository $produitrepository, CategorieRepository $categorierepository  ): Response
    {
        $categorie = $categorierepository->findAll();
        return $this->render('front/main/produit.html.twig', [
            'categorie' => $categorie,
            'new' => $produitrepository->findForHomepage(),
        ]);
    }


    /**
     * @Route("/front/main/contact", name="front_main_contact")
     */
    public function contact(Request $request, MailerInterface $mailer)
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()) {

            $contactFormData = $form->getData();
            
            $message = (new Email())
                ->from($contactFormData['email'])
                //->to('lateamtonapero@gmail.com')
                ->to('moneyandsucces@gmail.com')
                ->subject('Contact front end')
                ->text('Sender : '.$contactFormData['email'].\PHP_EOL.
                    $contactFormData['message'],
                    'text/plain');
            $mailer->send($message);

            $this->addFlash('success', 'Votre message a été envoyé');

            return $this->redirectToRoute('contact');
        }

        return $this->render('front/main/contact.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/front/main/trouver", name="front_main_trouver")
     */
    public function trouverAllS(TrouverRepository $trouverrepository): Response
    {
         $trouver = $trouverrepository->findAll();
        return $this->render('front/main/trouver.html.twig', [
            'trouver' => $trouver,
        ]);
    }

    

}
