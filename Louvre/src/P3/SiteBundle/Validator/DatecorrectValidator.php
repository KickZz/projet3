<?php
// src/P3/SiteBundle/Validator/DatecorrectValidator.php

namespace P3\SiteBundle\Validator;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;


/**
 * @Annotation
 */
class DatecorrectValidator extends ConstraintValidator
{
    private $requestStack;
    private $em;
    
  // Les arguments déclarés dans la définition du service arrivent au constructeur
  // On doit les enregistrer dans l'objet pour pouvoir s'en resservir dans la méthode validate()
  public function __construct(RequestStack $requestStack, EntityManagerInterface $em)
  {
    $this->requestStack = $requestStack;
    $this->em           = $em;
  }
    
  public function validate($value, Constraint $constraint)
  {
    $request = $this->requestStack->getCurrentRequest();

      // on recupère le repository de l'entité billet
    $billet = $this->em->getRepository('P3SiteBundle:Billet');
     // on va rechercher toutes les entités vendu à cette date
    $billetvendu = $billet->findBy(
    array ('datevisite' => $value));
    // on va compter le nombre de billet vendu à cette date
    $total = 0;
    foreach($billetvendu as $b){
        $a = $b->getNombrebillet();
        $total += $a ;
    }
    $date = new \DateTime("05/01/2017");
    $date2 = new \DateTime("11/01/2017");
    $date3 = new \DateTime("12/25/2017");
    $date4 = new \DateTime();
    $jour = $value->format('N');
    // Test pour savoir si la date est correcte
    if ($value->format('%Y') < $date4->format('%Y')) {
        $this->context->addViolation($constraint->message);
    }
    if ($value->format('%Y') == $date4->format('%Y')) {
       if ($value->format('%m') < $date4->format('%m')) {
        $this->context->addViolation($constraint->message);
    }
    }
    if ($value->format('%Y') == $date4->format('%Y')) {
       if ($value->format('%m') == $date4->format('%m')) {
            if ($value->format('%d') < $date4->format('%d')) {
                $this->context->addViolation($constraint->message);
            }
    }
    }
    
        
    if($value->format('%d') == $date->format('%d') || $value->format('%d') == $date2->format('%d') || $value->format('%d') == $date3->format('%d')) {
      
      if($value->format('%m') == $date->format('%m') || $value->format('%m') == $date2->format('%m') || $value->format('%m') == $date3->format('%m')) {
      
      $this->context->addViolation($constraint->message2);
    }
    }
    if ($jour == 2 || $jour == 7){
        $this->context->addViolation($constraint->message1);
    }
    if ($total >= 1000){
        $this->context->addViolation($constraint->message3);
    }      
  }
}