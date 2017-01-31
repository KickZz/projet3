<?php

// src/P3/SiteBundle/Controller/SiteController.php    

namespace P3\SiteBundle\Controller;

use P3\SiteBundle\Entity\Expo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SiteController extends Controller
{
    public function indexAction()
    {
        return $this->render('P3SiteBundle:Site:index.html.twig');
    }
    public function conditionAction()
    {
        return $this->render('P3SiteBundle:Site:condition.html.twig');
    }
    public function AdminAction(Request $request)
    {
        // On crée un objet Expo
        $expo = new Expo();
        
        // On crée le formulaire grâce au service form factory
        
        $form = $this->get('form.factory')->createBuilder(FormType::class, $expo)
            ->add('title', TextType::class)
            ->add('datestart', DateType::class)
            ->add('dateend', DateType::class)
            ->add('content', TextareaType::class)
            ->add('save', SubmitType::class)
            ->getForm()
        ;
        // Si la requête est en POST
        if ($request->isMethod('POST')) {
        // On fait le lien Requête <-> Formulaire
        // À partir de maintenant, la variable $advert contient les valeurs entrées dans le formulaire par le visiteur
        $form->handleRequest($request);

        // On vérifie que les valeurs entrées sont correctes
        // (Nous verrons la validation des objets en détail dans le prochain chapitre)
            if ($form->isValid()) {
            // On enregistre notre objet $advert dans la base de données, par exemple
            $em = $this->getDoctrine()->getManager();
            $em->persist($expo);
            $em->flush();
            }
        }
        // On passe la méthode createView() du formulaire à la vue
        // afin qu'elle puisse afficher le formulaire toute seule
        return $this->render('P3SiteBundle:Site:admin.html.twig', array(
           'form' => $form->createView(),
        ));
    }
}