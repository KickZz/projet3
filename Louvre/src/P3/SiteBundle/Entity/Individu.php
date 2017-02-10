<?php

namespace P3\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Individu
 *
 * @ORM\Table(name="individu")
 * @ORM\Entity(repositoryClass="P3\SiteBundle\Repository\IndividuRepository")
 */
class Individu
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var array
     *
     * @ORM\Column(name="pays", type="array")
     */
    private $pays;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datedenaissance", type="date")
     */
    private $datedenaissance;

    /**
     * @var bool
     *
     * @ORM\Column(name="tarifreduit", type="boolean")
     */
    private $tarifreduit;


    public function __construct()
  {
    
    $this->datedenaissance = new \Datetime();
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Individu
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Individu
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set pays
     *
     * @param array $pays
     *
     * @return Individu
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return array
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set datedenaissance
     *
     * @param \DateTime $datedenaissance
     *
     * @return Individu
     */
    public function setDatedenaissance($datedenaissance)
    {
        $this->datedenaissance = $datedenaissance;

        return $this;
    }

    /**
     * Get datedenaissance
     *
     * @return \DateTime
     */
    public function getDatedenaissance()
    {
        return $this->datedenaissance;
    }

    /**
     * Set tarifreduit
     *
     * @param boolean $tarifreduit
     *
     * @return Individu
     */
    public function setTarifreduit($tarifreduit)
    {
        $this->tarifreduit = $tarifreduit;

        return $this;
    }

    /**
     * Get tarifreduit
     *
     * @return bool
     */
    public function getTarifreduit()
    {
        return $this->tarifreduit;
    }

}
