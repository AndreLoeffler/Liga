<?php

namespace Binaerpiloten\LigaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SpielFilter
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class SpielFilter
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="year", type="integer", nullable=true)
     */
    private $year;
    
    /**
     * @ORM\ManyToMany(targetEntity="Volk")
     */
    protected $volk;
    
    /**
     * @ORM\ManyToMany(targetEntity="Mission")
     */
    protected $mission;
    
    /**
     * @ORM\ManyToMany(targetEntity="User")
     */
    protected $spieler;
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set year
     *
     * @param integer $year
     * @return SpielFilter
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer 
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set volk
     *
     * @param \Binaerpiloten\LigaBundle\Entity\Volk $volk
     * @return SpielFilter
     */
    public function setVolk(\Binaerpiloten\LigaBundle\Entity\Volk $volk = null)
    {
        $this->volk = $volk;

        return $this;
    }

    /**
     * Get volk
     *
     * @return \Binaerpiloten\LigaBundle\Entity\Volk 
     */
    public function getVolk()
    {
        return $this->volk;
    }

    /**
     * Set spieler
     *
     * @param \Binaerpiloten\LigaBundle\Entity\User $spieler
     * @return SpielFilter
     */
    public function setSpieler(\Binaerpiloten\LigaBundle\Entity\User $spieler = null)
    {
        $this->spieler = $spieler;

        return $this;
    }

    /**
     * Get spieler
     *
     * @return \Binaerpiloten\LigaBundle\Entity\User 
     */
    public function getSpieler()
    {
        return $this->spieler;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->spieler = new \Doctrine\Common\Collections\ArrayCollection();
        $this->volk = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add spieler
     *
     * @param \Binaerpiloten\LigaBundle\Entity\User $spieler
     * @return SpielFilter
     */
    public function addSpieler(\Binaerpiloten\LigaBundle\Entity\User $spieler)
    {
        $this->spieler[] = $spieler;

        return $this;
    }

    /**
     * Remove spieler
     *
     * @param \Binaerpiloten\LigaBundle\Entity\User $spieler
     */
    public function removeSpieler(\Binaerpiloten\LigaBundle\Entity\User $spieler)
    {
        $this->spieler->removeElement($spieler);
    }

    /**
     * Add volk
     *
     * @param \Binaerpiloten\LigaBundle\Entity\Volk $volk
     * @return SpielFilter
     */
    public function addVolk(\Binaerpiloten\LigaBundle\Entity\Volk $volk)
    {
        $this->volk[] = $volk;

        return $this;
    }

    /**
     * Remove volk
     *
     * @param \Binaerpiloten\LigaBundle\Entity\Volk $volk
     */
    public function removeVolk(\Binaerpiloten\LigaBundle\Entity\Volk $volk)
    {
        $this->volk->removeElement($volk);
    }

    /**
     * Set mission
     *
     * @param \Binaerpiloten\LigaBundle\Entity\Mission $mission
     * @return SpielFilter
     */
    public function setMission(\Binaerpiloten\LigaBundle\Entity\Mission $mission = null)
    {
        $this->mission = $mission;

        return $this;
    }

    /**
     * Get mission
     *
     * @return \Binaerpiloten\LigaBundle\Entity\Mission 
     */
    public function getMission()
    {
        return $this->mission;
    }

    /**
     * Add mission
     *
     * @param \Binaerpiloten\LigaBundle\Entity\Mission $mission
     * @return SpielFilter
     */
    public function addMission(\Binaerpiloten\LigaBundle\Entity\Mission $mission)
    {
        $this->mission[] = $mission;

        return $this;
    }

    /**
     * Remove mission
     *
     * @param \Binaerpiloten\LigaBundle\Entity\Mission $mission
     */
    public function removeMission(\Binaerpiloten\LigaBundle\Entity\Mission $mission)
    {
        $this->mission->removeElement($mission);
    }
}
