<?php

namespace Binaerpiloten\LigaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function profileAction()
    {
    		$user = $this->getUser();
    	
    		$name['first'] = $user->getName();
    		$name['last'] = $user->getSurname();
        return $this->render('BinaerpilotenLigaBundle:Website:profile.html.twig', 
        		array('name' => $name));
    }
}
