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
    	
      return $this->render('BinaerpilotenLigaBundle::base.html.twig', array('csrf_token' => $csrfToken));
    }
}
