<?php

    

namespace P3\CoreBundle\Controller;

use P3\SiteBundle\Entity\Billet;
use P3\SiteBundle\Entity\Individu;
use P3\SiteBundle\Entity\Expo;
use P3\SiteBundle\Entity\Liste;
use P3\SiteBundle\Form\ExpoType;
use P3\SiteBundle\Form\BilletType;
use P3\SiteBundle\Form\IndividuType;
use P3\SiteBundle\Form\ListeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Validator\Constraints\DateTime;


class CoreController extends Controller
{
public function indexAction(Request $request)
    {
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('P3SiteBundle:Expo');
        
        $listExpos = $repository->findAll();
        
                    // On crée un objet Billet
        $billet = new Billet();
        
        // On crée le formulaire grâce au service form factory en passant par le le formulaire BilletType
        
        $form = $this->createForm(BilletType::class, $billet);    
        // Si la requête est en POST
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
      $em->persist($billet);
      $em->flush();
    
            return $this->redirectToRoute('p3_site_coordonnees', array
                                          ('id' => $billet->getId()));
           
    }
        // On passe la méthode createView() du formulaire à la vue
        // afin qu'elle puisse afficher le formulaire toute seule
        return $this->render('P3SiteBundle:Site:commande.html.twig', array(
           'form' => $form->createView(),
            'listExpos' => $listExpos,
        ));
    }
}