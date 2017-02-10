<?php

namespace P3\SiteBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Liste
 *
 * @ORM\Table(name="liste")
 * @ORM\Entity(repositoryClass="P3\SiteBundle\Repository\ListeRepository")
 */
class Liste
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
    * @ORM\ManyToMany(targetEntity="P3\SiteBundle\Entity\Individu", cascade={"persist"})
    */
    private $individus;
    
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;
    
    public function __construct()
  {
    
    $this->individus = new ArrayCollection();
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
     * Add individus
     *
     * @param \P3\SiteBundle\Entity\Individu $individus
     *
     * @return Liste
     */
    public function addIndividus(\OC\PlatformBundle\Entity\Category $individus)
    {
        $this->individus[] = $individus;

        return $this;
    }

    /**
     * Remove individus
     *
     * @param \P3\SiteBundle\Entity\Individu $individus
     */
    public function removeIndividus(\OC\PlatformBundle\Entity\Category $individus)
    {
        $this->individus->removeElement($individus);
    }

    /**
     * Get individus
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getIndividus()
    {
        return $this->individus;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Liste
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
}
