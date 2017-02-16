<?php

// src/P3/SiteBundle/Controller/SiteController.php    

namespace P3\SiteBundle\Controller;

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


class SiteController extends Controller
{
        
    public function conditionAction()
    {
        return $this->render('P3SiteBundle:Site:condition.html.twig');
    }
    public function ficheAction($id, Request $request)
    {
        $em = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('P3SiteBundle:Expo');

        $expo = $em->find($id);
        return $this->render('P3SiteBundle:Site:fiche.html.twig', array(
        'expo' => $expo));
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
    public function carrouselAction(Request $request)
  {
    $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('P3SiteBundle:Expo');
        
        $listExpo = $repository->findAll();

    return $this->render('P3SiteBundle:Site:carrousel.html.twig', array(
      'listExpo' => $listExpo
    ));
  }
    public function coordonneesAction($id, Request $request)
    {

        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('P3SiteBundle:Expo');
        
        $listExpos = $repository->findAll();
        
        $em = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('P3SiteBundle:Billet');

        $billet = $em->find($id);
        $nbbillet = $billet->getNombrebillet();
        $liste = new Liste();
           
        for ($i = 1; $i <= $nbbillet;$i++)
        {
            // On crée un objet Individu
            $individu = new Individu();
            $liste->getIndividus()->add($individu);
            
               
        }
        // On crée le formulaire grâce au service form factory en passant par le le formulaire ListeType
        $form = $this->createForm(ListeType::class, $liste);
        // Si la requête est en POST
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      
      $em = $this->getDoctrine()->getManager();
      $em->persist($liste);
           
      $em->flush();
        
        
        
    
            return $this->redirectToRoute('p3_site_paiement', array
                                          ('id' => $billet->getId(),
                                           'idliste' => $liste->getId()));
           
    }
        // On passe la méthode createView() du formulaire à la vue
        // afin qu'elle puisse afficher le formulaire toute seule
        return $this->render('P3SiteBundle:Site:coordonnees.html.twig', array(
           'form' => $form->createView(),
           'listExpos' => $listExpos,
           
        ));
    }
    public function paiementAction($id, $idliste, Request $request)
    {
            $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('P3SiteBundle:Expo');
        
            $listExpos = $repository->findAll();
        // On va chercher l'entity billet correspondant à la liste
            $em = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('P3SiteBundle:Billet');
        
            $billet = $em->find($id);
            $nbbillet = $billet->getNombrebillet();
            $datevisite = $billet->getDatevisite();
            $type = $billet->getType();
        // On va chercher l'entity Liste correspondant à la commande
            $em = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('P3SiteBundle:Liste');

            $liste = $em->find($idliste);
        // On va chercher les entités individu présentent dans la liste
            $em = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('P3SiteBundle:individu');
        
            $individus = $liste->getIndividus();
            $email = $liste->getEmail();
            $total = 0 ;
            
        foreach ($individus->toArray() as $individu)
        {
            
            $idindividu = $individu->getId();

            $personne = $em->find($idindividu);
            $tarifreduit = $personne->getTarifreduit();
            //aller chercher date de naissance et la comparer
            $date = $personne->getDatedenaissance();
            
            //comparaison des dates
            $age = $datevisite->diff($date)->format('%Y');
            if ($age < 4){
                    $cout = 0;
            }
            else if ($tarifreduit != true)
            {
    
                if ($age >= 4 && $age < 12){
                    $cout = 8;
                }
                else if ($age >= 12 && $age < 60){
                    $cout = 16;
                }
                else if ($age >= 60){
                    $cout = 12;
                }
                
            }
            else if ($tarifreduit == true){
                $cout = 10;
            }
            
            
          $total += $cout;  
        }
        // multiplication par 100 pour stripe
        $total = $total*100;
        if ($total > 0){
         if ($request->isMethod('POST')){
            // Set your secret key: remember to change this to your live secret key in production
            // See your keys here: https://dashboard.stripe.com/account/apikeys
            \Stripe\Stripe::setApiKey("sk_test_r0EVQqmwZ84Vo16kM3CA6hLV");

            // Token is created using Stripe.js or Checkout!
            // Get the payment token submitted by the form:
            $token = $_POST['stripeToken'];

            // Charge the user's card:
            $charge = \Stripe\Charge::create(array(
                "amount" => $total,
                "currency" => "eur",
                "description" => "Example charge",
                "source" => $token,
            ));
            //Envoi de l'email de confirmation
            $message = \Swift_Message::newInstance()
                ->setSubject('Vos Billets')
                ->setFrom('symfonyprojet@gmail.com')
                ->setTo($email)
                ->setBody($this->renderView(
                    'P3SiteBundle:Site:email.html.twig',
                    array(
                        'individus' => $individus)),
                          'text/html');

            $this->get('mailer')->send($message);
            $request->getSession()->getFlashBag()->add('paiement', "Le paiement à bien été enregistré, retrouvez vos billets à l'adresse mail renseignée");

            return $this->redirectToRoute('p3_core_homepage');
         }
        }
        else if ($total == 0){
            //Envoi de l'email de confirmation
            $message = \Swift_Message::newInstance()
                ->setSubject('Vos Billets')
                ->setFrom('symfonyprojet@gmail.com')
                ->setTo($email)
                ->setBody($this->renderView(
                    'P3SiteBundle:Site:email.html.twig',
                    array(
                        'individus' => $individus)),
                          'text/html');

            $this->get('mailer')->send($message);
            $request->getSession()->getFlashBag()->add('paiement', "Votre commande à bien été enregistrée, retrouvez vos billets à l'adresse mail renseignée");

            return $this->redirectToRoute('p3_core_homepage');
        }
        return $this->render('P3SiteBundle:Site:paiement.html.twig', array(
           'listExpos' => $listExpos,
           'id' => $id,
           'idliste' => $idliste,
        ));
    }
}