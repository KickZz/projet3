<?php

namespace P3\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
     */
    private $datevisite;

    /**
     * @var array
     *
     * @ORM\Column(name="type", type="array")
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="nombrebillet", type="integer")
     */
    private $nombrebillet;


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

