<?php

namespace Binaerpiloten\LigaBundle\Twig;

class UserExtension extends \Twig_Extension {

    protected $em;

    public function __construct($em) {
        $this->em = $em;
    }
    
    public function getFunctions() {
        return array(new \Twig_SimpleFunction('globalGetUsers', array($this, 'globalGetUsers')));
    }

    public function globalGetToken() {
    		$entities = $em->getRepository('BinaerpilotenLigaBundle:User')->findAll();        
        return $entities;
    }

    public function getName()
    {
        return 'user_extension';
    }
}