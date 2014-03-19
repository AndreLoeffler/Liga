<?php

namespace Binaerpiloten\LigaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Binaerpiloten\LigaBundle\Entity\SpielFilter;
use Binaerpiloten\LigaBundle\Form\SpielFilterType;

/**
 * SpielFilter controller.
 *
 * @Route("/spielfilter")
 */
class SpielFilterController extends Controller
{

    /**
     * Creates a new SpielFilter entity.
     *
     * @Route("/", name="spielfilter_create")
     * @Method("POST")
     * @Template("BinaerpilotenLigaBundle:SpielFilter:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new SpielFilter();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {

            return $this->displayResults($entity);
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a SpielFilter entity.
    *
    * @param SpielFilter $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(SpielFilter $entity)
    {
        $form = $this->createForm(new SpielFilterType(), $entity, array(
            'action' => $this->generateUrl('spielfilter_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new SpielFilter entity.
     *
     * @Route("/new", name="spielfilter_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new SpielFilter();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /* ================== Helpers go here ==================== */
    
    /**
     * Displays list of matches filtered by Filter-object.
     */
    private function displayResults(SpielFilter $filter) {
    	
    	$em = $this->getDoctrine()->getManager();
    	
    	$entities = $em->getRepository('BinaerpilotenLigaBundle:Spiel')->findAll();
    	
    	if ($filter->getYear() != null) {
    		$year = $filter->getYear();
    		foreach ($entities as $k=>$e) {
    			if($e->getDatum()->format('Y') != $year) {
    				unset($entities[$k]);
    			}
    		}
    	}
    	
        	if ($filter->getVolk() != null || $filter->getVolk2() != null) {
    		$voelker = array();
    		if ($a = $filter->getVolk()) $voelker[] = $a;
    		if ($a = $filter->getVolk2()) $voelker[] = $a;
    		foreach ($entities as $k=>$e) {
					if (sizeof($voelker) > 1) {
						if (!in_array($e->getYouarmee()->getVolk(),$voelker) || !in_array($e->getEnemyarmee()->getVolk(),$voelker))
							unset($entities[$k]);
					} else {
						if (!in_array($e->getYouarmee()->getVolk(),$voelker) && !in_array($e->getEnemyarmee()->getVolk(),$voelker))
							unset($entities[$k]);
					}   			
    		}
    	}
    	
    	if ($filter->getSpieler() != null || $filter->getSpieler2() != null) {
    		$spieler = array();
    		if ($a = $filter->getSpieler()) $spieler[] = $a;
    		if ($a = $filter->getSpieler2()) $spieler[] = $a;
    		foreach ($entities as $k=>$e) {
					if (sizeof($spieler) > 1) {
						if (!in_array($e->getYou(),$spieler) || !in_array($e->getEnemy(),$spieler))
							unset($entities[$k]);
					} else {
						if (!in_array($e->getYou(),$spieler) && !in_array($e->getEnemy(),$spieler))
							unset($entities[$k]);
					}   			
    		}
    	}
    	
    	return $this->render('BinaerpilotenLigaBundle:Spiel:index.html.twig',
    			array('entities' => $entities)
    	);
    	
    }
}
