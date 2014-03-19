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
     * @ORM\ManyToOne(targetEntity="Volk", inversedBy="filter")
     * @ORM\JoinColumn(name="volk_id", referencedColumnName="id", nullable=true)
     */
    protected $volk;
    
    /**
     * @ORM\ManyToOne(targetEntity="Volk", inversedBy="filter")
     * @ORM\JoinColumn(name="volk2_id", referencedColumnName="id", nullable=true)
     */
    protected $volk2;
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="filter")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=true)
     */
    protected $spieler;
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="filter")
     * @ORM\JoinColumn(name="user2_id", referencedColumnName="id", nullable=true)
     */
    protected $spieler2;
    
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
     * Set spieler2
     *
     * @param \Binaerpiloten\LigaBundle\Entity\User $spieler2
     * @return SpielFilter
     */
    public function setSpieler2(\Binaerpiloten\LigaBundle\Entity\User $spieler2 = null)
    {
        $this->spieler2 = $spieler2;

        return $this;
    }

    /**
     * Get spieler2
     *
     * @return \Binaerpiloten\LigaBundle\Entity\User 
     */
    public function getSpieler2()
    {
        return $this->spieler2;
    }

    /**
     * Set volk2
     *
     * @param \Binaerpiloten\LigaBundle\Entity\Volk $volk2
     * @return SpielFilter
     */
    public function setVolk2(\Binaerpiloten\LigaBundle\Entity\Volk $volk2 = null)
    {
        $this->volk2 = $volk2;

        return $this;
    }

    /**
     * Get volk2
     *
     * @return \Binaerpiloten\LigaBundle\Entity\Volk 
     */
    public function getVolk2()
    {
        return $this->volk2;
    }
}
