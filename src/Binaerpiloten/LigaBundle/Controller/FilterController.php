<?php

namespace Binaerpiloten\LigaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Binaerpiloten\LigaBundle\Entity\Filter;
use Binaerpiloten\LigaBundle\Form\FilterType;

/**
 * Filter controller.
 *
 * @Route("/filter")
 */
class FilterController extends Controller
{

    /**
     * Creates a new Filter entity.
     *
     * @Route("/", name="filter_create")
     * @Method("POST")
     * @Template("BinaerpilotenLigaBundle:Filter:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Filter();
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
    * Creates a form to create a Filter entity.
    *
    * @param Filter $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Filter $entity)
    {
        $form = $this->createForm(new FilterType(), $entity, array(
            'action' => $this->generateUrl('filter_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Filter entity.
     *
     * @Route("/new", name="filter_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Filter();
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
    private function displayResults(Filter $filter) {
    	
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
    	
    	if ($filter->getVolk() != null) {
    		$volk = $filter->getVolk();
    		foreach ($entities as $k=>$e) {
    			if($e->getYouarmee()->getVolk() != $volk && $e->getEnemyarmee()->getVolk() != $volk) {
    				unset($entities[$k]);
    			}
    		}
    	}
    	
    	return $this->render(
    			'BinaerpilotenLigaBundle:Spiel:index.html.twig',
    			array('entities' => $entities)
    	);
    	
    }
}
