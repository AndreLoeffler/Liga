<?php

namespace Binaerpiloten\LigaBundle\Twig;

class ArmeeExtension extends \Twig_Extension {

    protected $em;
    protected $context;

    public function __construct($em, $context) {
        $this->em = $em;
        $this->context = $context;
    }
    
    public function getUser() {
    	return $this->context->getToken()->getUser();
    }

    public function getFunctions() {
        return array(new \Twig_SimpleFunction('globalGetArmeen', array($this, 'globalGetArmeen')));
    }

    public function globalGetArmeen() {
    		$user = $this->getUser();
        $qarmeen = $this->em->createQuery("SELECT r " .
      		"FROM Binaerpiloten\LigaBundle\Entity\Armee r " .
      		"WHERE r.user = ".$this->getUser()->getId() );
      
      	$armeen = $qarmeen->getResult();
      	return $armeen;
    }

    public function getName()
    {
        return 'armee_extension';
    }
}