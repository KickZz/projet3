<?php

namespace P3\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Expo
 *
 * @ORM\Table(name="expo")
 * @ORM\Entity(repositoryClass="P3\SiteBundle\Repository\ExpoRepository")
 */
class Expo
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
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\NotNull
     */
    private $title;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datestart", type="date")
     * @Assert\DateTime()
     */
    private $datestart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateend", type="date")
     * @Assert\DateTime()
     */
    private $dateend;
    
    /**
     * @ORM\OneToOne(targetEntity="P3\SiteBundle\Entity\Image", cascade={"persist", "remove"})
     * @Assert\Image(minWidth=1280, maxWidth=1280, minHeight=600, maxHeight=600)
     */
    private $image;
    
    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;


    public function __construct()
    {
    $this->datestart = new \Datetime();
    $this->dateend = new \Datetime();
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
     * Set title
     *
     * @param string $title
     *
     * @return Expo
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set datestart
     *
     * @param \DateTime $datestart
     *
     * @return Expo
     */
    public function setDatestart($datestart)
    {
        $this->datestart = $datestart;

        return $this;
    }

    /**
     * Get datestart
     *
     * @return \DateTime
     */
    public function getDatestart()
    {
        return $this->datestart;
    }

    /**
     * Set dateend
     *
     * @param \DateTime $dateend
     *
     * @return Expo
     */
    public function setDateend($dateend)
    {
        $this->dateend = $dateend;

        return $this;
    }

    /**
     * Get dateend
     *
     * @return \DateTime
     */
    public function getDateend()
    {
        return $this->dateend;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Expo
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set image
     *
     * @param \P3\SiteBundle\Entity\Image $image
     *
     * @return Expo
     */
    public function setImage(\P3\SiteBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \P3\SiteBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }
}
