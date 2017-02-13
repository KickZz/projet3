<?php
namespace P3\SiteBundle\Validator;

use Symfony\Component\Validator\Context\ExecutionContextInterface;

class Validatetype {

public static function Type($object, ExecutionContextInterface $context, $payload)
    {
    // verification de l'heure 
        $date = $object->getDatevisite();
        $today = new \DateTime();
        $choix = $object->getType();
        $heure = $today->format('H');
        if ($choix == true){
            if ($date == $today){
                if ($heure > 7){
                    $context
                        ->buildViolation("Impossible de commander un billet 'Journée' après 14h pour le joue même")
                        ->atPath('type')
                        ->addViolation();
                }
            }
            
            }
        
    }
}