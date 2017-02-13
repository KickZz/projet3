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
 * @Assert\Callback({"P3\SiteBundle\Validator\Validatetype", "Type"})
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


    
    public function validateType(ExecutionContextInterface $context, $payload)
    {
    // verification de l'heure 
        $date = $this->getDatevisite();
        $today = new \DateTime();
        $choix = $this->getType();
        $heure = $today->format('H');
        if ($choix == true){
            if ($date == $today){
                if ($heure >= 7){
                    $context
                        ->buildViolation("Impossible de commander un billet 'Journée' après 14h pour le joue même")
                        ->atPath('type')
                        ->addViolation();
                }
            }
            
            }
        
    }
    public function __construct()
    {
    $this->datevisite = new \Datetime();
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
}