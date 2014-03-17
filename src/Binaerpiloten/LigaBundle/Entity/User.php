<?php

namespace Binaerpiloten\LigaBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var String
     * 
     * @ORM\Column(name="Vorname", type="string")
     * @Assert\NotBlank(message="Please enter your name.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max="255",
     *     minMessage="The name is too short.",
     *     maxMessage="The name is too long.",
     *     groups={"Registration", "Profile"}
     * )
     */
		
    private $vorname;
    
    /**
     * @var String
     *
     * @ORM\Column(name="Nachname", type="string")
     * @Assert\NotBlank(message="Please enter your name.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max="255",
     *     minMessage="The name is too short.",
     *     maxMessage="The name is too long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    
    private $nachname;
    
    /**
     * @ORM\OneToMany(targetEntity="Armee", mappedBy="user")
     */
    private $armeen;
    
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
     * Set vorname
     *
     * @param string $vorname
     * @return User
     */
    public function setVorname($vorname)
    {
        $this->vorname = $vorname;

        return $this;
    }

    /**
     * Get vorname
     *
     * @return string 
     */
    public function getVorname()
    {
        return $this->vorname;
    }

    /**
     * Set nachname
     *
     * @param string $nachname
     * @return User
     */
    public function setNachname($nachname)
    {
        $this->nachname = $nachname;

        return $this;
    }

    /**
     * Get nachname
     *
     * @return string 
     */
    public function getNachname()
    {
        return $this->nachname;
    }
    
    public function __construct()
    {
    	parent::__construct();
    	
    	$this->armeen = new ArrayCollection();
    }

    /**
     * Add armeen
     *
     * @param \Binaerpiloten\LigaBundle\Entity\Armee $armeen
     * @return User
     */
    public function addArmeen(\Binaerpiloten\LigaBundle\Entity\Armee $armeen)
    {
        $this->armeen[] = $armeen;

        return $this;
    }

    /**
     * Remove armeen
     *
     * @param \Binaerpiloten\LigaBundle\Entity\Armee $armeen
     */
    public function removeArmeen(\Binaerpiloten\LigaBundle\Entity\Armee $armeen)
    {
        $this->armeen->removeElement($armeen);
    }

    /**
     * Get armeen
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArmeen()
    {
        return $this->armeen;
    }
    
    public function getWins() {
    	$win = 0;
    	foreach ($this->armeen as $a) {
    		$win += $a->getWin();
    	}
    	return $win;
    }
    public function getEvens() {
    	$even = 0;
    	foreach ($this->armeen as $a) {
    		$even += $a->getEven();
    	}
    	return $even;
    }
    public function getLosses() {
    	$loss = 0;
    	foreach ($this->armeen as $a) {
    		$loss += $a->getLoss();
    	}
    	return $loss;
    }
    
    public function evaluateRank() {
    		$win = $this->getWins();
    		$even = $this->getEvens();
    		return (1+ $win +( $even / 2 )) / ( 2 + $win + $even + $this->getLosses());
    }

}
