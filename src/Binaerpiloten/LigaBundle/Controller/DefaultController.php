<?php

namespace Binaerpiloten\LigaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
      return $this->render('BinaerpilotenLigaBundle::base.html.twig', 
      		array());
    }
}