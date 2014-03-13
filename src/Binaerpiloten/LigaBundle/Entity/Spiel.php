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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="id")
     */
		private $you;
		
		/**
		 * @var User
		 *
		 * @ORM\ManyToOne(targetEntity="User", inversedBy="id")
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
		 * @ORM\ManyToOne(targetEntity="Armee", inversedBy="id")
		 */
		
		private $youarmee;
		
		/**
		 * @ORM\ManyToOne(targetEntity="Armee", inversedBy="id")
		 */
		
		private $enemyarmee;

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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->you = new \Doctrine\Common\Collections\ArrayCollection();
        $this->enemy = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add you
     *
     * @param \Binaerpiloten\LigaBundle\Entity\User $you
     * @return Spiel
     */
    public function addYou(\Binaerpiloten\LigaBundle\Entity\User $you)
    {
        $this->you[] = $you;

        return $this;
    }

    /**
     * Remove you
     *
     * @param \Binaerpiloten\LigaBundle\Entity\User $you
     */
    public function removeYou(\Binaerpiloten\LigaBundle\Entity\User $you)
    {
        $this->you->removeElement($you);
    }

    /**
     * Add enemy
     *
     * @param \Binaerpiloten\LigaBundle\Entity\User $enemy
     * @return Spiel
     */
    public function addEnemy(\Binaerpiloten\LigaBundle\Entity\User $enemy)
    {
        $this->enemy[] = $enemy;

        return $this;
    }

    /**
     * Remove enemy
     *
     * @param \Binaerpiloten\LigaBundle\Entity\User $enemy
     */
    public function removeEnemy(\Binaerpiloten\LigaBundle\Entity\User $enemy)
    {
        $this->enemy->removeElement($enemy);
    }

    /**
     * Set enemyarmee
     *
     * @param \Binaerpiloten\LigaBundle\Entity\Armee $enemyarmee
     * @return Spiel
     */
    public function setEnemyarmee(\Binaerpiloten\LigaBundle\Entity\Armee $enemyarmee = null)
    {
        $this->enemyarmee = $enemyarmee;

        return $this;
    }

    /**
     * Get enemyarmee
     *
     * @return \Binaerpiloten\LigaBundle\Entity\Armee 
     */
    public function getEnemyarmee()
    {
        return $this->enemyarmee;
    }

    /**
     * Set youarmee
     *
     * @param \Binaerpiloten\LigaBundle\Entity\Armee $youarmee
     * @return Spiel
     */
    public function setYouarmee(\Binaerpiloten\LigaBundle\Entity\Armee $youarmee = null)
    {
        $this->youarmee = $youarmee;

        return $this;
    }

    /**
     * Get youarmee
     *
     * @return \Binaerpiloten\LigaBundle\Entity\Armee 
     */
    public function getYouarmee()
    {
        return $this->youarmee;
    }
}
