<?php

// src/P3/SiteBundle/Controller/SiteController.php    

namespace P3\SiteBundle\Controller;

use P3\SiteBundle\Entity\Expo;
use P3\SiteBundle\Form\ExpoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
    public function adminAction(Request $request)
    {
        // On crée un objet Expo
        $expo = new Expo();
        
        // On crée le formulaire grâce au service form factory en passant par le le formulaire ExpoType
        
        $form = $this->createForm(ExpoType::class, $expo);
            
        // Si la requête est en POST
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      
      $em = $this->getDoctrine()->getManager();
      $em->persist($expo);
      $em->flush();
            // Ajout d'un message pour confirmer l'ajout de l'annonce en BDD
      $request->getSession()->getFlashBag()->add('notice', 'Exposition ajoutée.');

      
    }
        // On passe la méthode createView() du formulaire à la vue
        // afin qu'elle puisse afficher le formulaire toute seule
        return $this->render('P3SiteBundle:Site:admin.html.twig', array(
           'form' => $form->createView(),
        ));
    }
    public function supprimerAction(Request $request)
    {
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('P3SiteBundle:Expo');
        
        $listExpo = $repository->findAll();
        
        // On crée un formulaire vide, qui ne contiendra que le champ CSRF
    // Cela permet de protéger la suppression d'annonce contre cette faille
    $form = $this->get('form.factory')->create();
        
        return $this->render('P3SiteBundle:Site:adminsupprimer.html.twig', array(
                            'listExpo' => $listExpo,
                            'form'   => $form->createView(),));
    }
    public function suppressionAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

    $expo = $em->getRepository('P3SiteBundle:Expo')->find($id);

    if (null === $expo) {
      throw new NotFoundHttpException("L'exposition d'id ".$id." n'existe pas.");
    }

    

    if ($request->isMethod('POST')){
      $em->remove($expo);
      $em->flush();

      $request->getSession()->getFlashBag()->add('info', "L'exposition a bien été supprimée.");

      return $this->redirectToRoute('p3_site_adminsupprimer');
    }
    }
    
}