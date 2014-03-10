<?php

namespace Binaerpiloten\LigaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Spiel
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Spiel
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
     * @var \DateTime
     *
     * @ORM\Column(name="datum", type="date")
     */
    private $datum;
    
    /**
     * @var User
     * 
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="you_id", referencedColumnName="id")
     */
		private $you;
		
		/**
		 * @var User
		 *
		 * @ORM\OneToOne(targetEntity="User")
		 * @ORM\JoinColumn(name="enemy_id", referencedColumnName="id")
		 */
		private $enemy;
		
		/**
		 * @var String
		 *
		 * @ORM\Column(name="Mission", type="string")
		 */
		
		private $mission;
		
		/**
		 * @var integer
		 *
		 * @ORM\Column(name="youpunkte", type="integer")
		 */
		private $youpunkte;
		
		/**
		 * @var integer
		 *
		 * @ORM\Column(name="enemypunkte", type="integer")
		 */
		private $enemypunkte;
		

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
     * Set datum
     *
     * @param \DateTime $datum
     * @return Spiel
     */
    public function setDatum($datum)
    {
        $this->datum = $datum;

        return $this;
    }

    /**
     * Get datum
     *
     * @return \DateTime 
     */
    public function getDatum()
    {
        return $this->datum;
    }

    /**
     * Set mission
     *
     * @param string $mission
     * @return Spiel
     */
    public function setMission($mission)
    {
        $this->mission = $mission;

        return $this;
    }

    /**
     * Get mission
     *
     * @return string 
     */
    public function getMission()
    {
        return $this->mission;
    }

    /**
     * Set youpunkte
     *
     * @param integer $youpunkte
     * @return Spiel
     */
    public function setYoupunkte($youpunkte)
    {
        $this->youpunkte = $youpunkte;

        return $this;
    }

    /**
     * Get youpunkte
     *
     * @return integer 
     */
    public function getYoupunkte()
    {
        return $this->youpunkte;
    }

    /**
     * Set enemypunkte
     *
     * @param integer $enemypunkte
     * @return Spiel
     */
    public function setEnemypunkte($enemypunkte)
    {
        $this->enemypunkte = $enemypunkte;

        return $this;
    }

    /**
     * Get enemypunkte
     *
     * @return integer 
     */
    public function getEnemypunkte()
    {
        return $this->enemypunkte;
    }

    /**
     * Set you
     *
     * @param \Binaerpiloten\LigaBundle\Entity\User $you
     * @return Spiel
     */
    public function setYou(\Binaerpiloten\LigaBundle\Entity\User $you = null)
    {
        $this->you = $you;

        return $this;
    }

    /**
     * Get you
     *
     * @return \Binaerpiloten\LigaBundle\Entity\User 
     */
    public function getYou()
    {
        return $this->you;
    }

    /**
     * Set enemy
     *
     * @param \Binaerpiloten\LigaBundle\Entity\User $enemy
     * @return Spiel
     */
    public function setEnemy(\Binaerpiloten\LigaBundle\Entity\User $enemy = null)
    {
        $this->enemy = $enemy;

        return $this;
    }

    /**
     * Get enemy
     *
     * @return \Binaerpiloten\LigaBundle\Entity\User 
     */
    public function getEnemy()
    {
        return $this->enemy;
    }
}
