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
     * @ORM\OneToMany(targetEntity="Armee", mappedBy="player")
     */
    private $armeen;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="win", type="integer")
     */
    protected $win;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="even", type="integer")
     */
    protected $even;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="loss", type="integer")
     */
    protected $loss;
    
    

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

    /**
     * Set win
     *
     * @param integer $win
     * @return User
     */
    public function setWin($win)
    {
        $this->win = $win;

        return $this;
    }

    /**
     * Get win
     *
     * @return integer 
     */
    public function getWin()
    {
        return $this->win;
    }

    /**
     * Set even
     *
     * @param integer $even
     * @return User
     */
    public function setEven($even)
    {
        $this->even = $even;

        return $this;
    }

    /**
     * Get even
     *
     * @return integer 
     */
    public function getEven()
    {
        return $this->even;
    }

    /**
     * Set loss
     *
     * @param integer $loss
     * @return User
     */
    public function setLoss($loss)
    {
        $this->loss = $loss;

        return $this;
    }

    /**
     * Get loss
     *
     * @return integer 
     */
    public function getLoss()
    {
        return $this->loss;
    }
    
    public function won() {
    	$this->win++;
    }
    public function tied() {
    	$this->even++;
    }
    public function lost() {
    	$this->loss++;
    }
    
    
}
