<?php
// src/P3/SiteBundle/Validator/Datecorrect.php

namespace P3\SiteBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Datecorrect extends Constraint
{
  public $message = "La date choisie est incorrecte (Impossible de réserver pour les jours passées)";
  public $message1 = "La date choisie est incorrecte (Impossible de réserver pour le mardi ou le dimanche)";
  public $message2 = "La date choisie est incorrecte (Impossible de réserver pour les jours fériés indiqués dans la partie accueil)";
  public $message3 = "Plus de billet disponible pour cette date";
  public $message4 = "Le musée à fermé ses portes, impossible de commander pour le jour même après 19h.";
  
    
  public function validatedBy()
  {
    return 'p3_site_datecorrect'; // Ici, on fait appel à l'alias du service
  }

}