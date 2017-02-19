<?php

namespace P3\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use P3\SiteBundle\Validator\Datecorrect;
use Symfony\Component\Validator\Context\ExecutionContextInterface;


/**
 * Billet
 *
 * @ORM\Table(name="billet")
 * @ORM\Entity(repositoryClass="P3\SiteBundle\Repository\BilletRepository")
 */
class Billet
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datevisite", type="date")
     * @Assert\DateTime()
     * @Datecorrect()
     */
    private $datevisite;

    /**
     * @var array
     * @ORM\Column(name="type", type="array")
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="nombrebillet", type="integer")
     * @Assert\NotNull
     */
    private $nombrebillet;

    public function __construct()
    {
    $this->datevisite = new \Datetime('now',new \DateTimeZone('Europe/Paris'));
    }
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set datevisite
     *
     * @param \DateTime $datevisite
     *
     * @return Billet
     */
    public function setDatevisite($datevisite)
    {
        $this->datevisite = $datevisite;

        return $this;
    }

    /**
     * Get datevisite
     *
     * @return \DateTime
     */
    public function getDatevisite()
    {
        return $this->datevisite;
    }

    /**
     * Set type
     *
     * @param array $type
     *
     * @return Billet
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return array
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set nombrebillet
     *
     * @param integer $nombrebillet
     *
     * @return Billet
     */
    public function setNombrebillet($nombrebillet)
    {
        $this->nombrebillet = $nombrebillet;

        return $this;
    }

    /**
     * Get nombrebillet
     *
     * @return int
     */
    public function getNombrebillet()
    {
        return $this->nombrebillet;
    }
    /**
     * @Assert\Callback
     */
    public function isTypeValid(ExecutionContextInterface $context, $payload)
    {
    // verification de l'heure
        
        $date = $this->getDatevisite();
        $today = new \DateTime('now',new \DateTimeZone('Europe/Paris'));     
        $heure = $today->format('H');
        $choix = $this->getType();
        if ($choix == true){
            if ($date->format('%Y') == $today->format('%Y')) {
                if ($date->format('%m') == $today->format('%m')) {
                    if ($date->format('%d') == $today->format('%d')){
            
                        if ($heure >= 14){
                            $context
                                ->buildViolation("Impossible de commander un billet 'Journée' après 14h pour le jour même")
                                ->atPath('type')
                                ->addViolation()
                            ;
                        }
                    }
            
                }
        
            }
        }
    }
}