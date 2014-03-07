<?php

namespace Binaerpiloten\LigaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	$csrfToken = $this->container->has('form.csrf_provider')
    	? $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate')
    	: null;
    	
    	$armeen = $this->getArmeen();
    	
      return $this->render('BinaerpilotenLigaBundle::base.html.twig', 
      		array('csrf_token' => $csrfToken, 'armeen' => $armeen));
    }
    
    public function getArmeen() {
    	$em = $em = $this->getDoctrine()->getManager();
      $armeen = array();

      $qarmeen = $em->createQuery("SELECT r " .
      		"FROM Binaerpiloten\LigaBundle\Entity\Armee r " .
      		"WHERE r.user = ".$this->getUser()->getId() );
      
      $armeen = $qarmeen->getResult();
      
      return $armeen;
    }
}