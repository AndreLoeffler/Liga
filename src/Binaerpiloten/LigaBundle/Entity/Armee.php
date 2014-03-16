<?php

namespace Binaerpiloten\LigaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Armee
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Armee
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="beschreibung", type="string", length=5000)
     */
    private $beschreibung;
    
		/**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="armeen")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;
    
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
     * Set name
     *
     * @param string $name
     * @return Armee
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set beschreibung
     *
     * @param string $beschreibung
     * @return Armee
     */
    public function setBeschreibung($beschreibung)
    {
        $this->beschreibung = $beschreibung;

        return $this;
    }

    /**
     * Get beschreibung
     *
     * @return string 
     */
    public function getBeschreibung()
    {
        return $this->beschreibung;
    }

    /**
     * Set user
     *
     * @param \Binaerpiloten\LigaBundle\Entity\User $user
     * @return Armee
     */
    public function setUser(\Binaerpiloten\LigaBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Binaerpiloten\LigaBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
    
    public function __toString() {
    	return $this->name;
    }

    /**
     * Set win
     *
     * @param integer $win
     * @return Armee
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
     * @return Armee
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
     * @return Armee
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
