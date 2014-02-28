<?php

namespace Binaerpiloten\LigaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('BinaerpilotenLigaBundle:Default:index.html.twig', array('name' => $name));
    }
}
