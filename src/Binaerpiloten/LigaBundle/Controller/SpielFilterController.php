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
        $form = $this->createForm(new SpielFilterType($this->getDoctrine()->getManager()), $entity, array(
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

    /**
     * Displays list of matches filtered by Filter-object.
     */
    private function displayResults(SpielFilter $filter) {
    	$em = $this->getDoctrine()->getManager();

    	$repository = $this->getDoctrine()->getRepository('BinaerpilotenLigaBundle:Spiel');
    	$query = $repository->createQueryBuilder('s');
    	$parameters = array();
    	
    	if ($filter->getYear() != null) {
    		$year = $filter->getYear();
    		foreach ($year as $k=>$y) {
    			$query->orWhere($query->expr()->between('s.datum',':from'.$k,':to'.$k));
    			$parameters[':from'.$k] = new \DateTime($y.'-01-01');
    			$parameters[':to'.$k] = new \DateTime($y.'-12-31');
    		}
    	}
    	
    	if ($filter->getVolk() != null) {
    		$voelker = $filter->getVolk()->toArray();
    		if (sizeof($voelker) == 1) {
    			$query->andWhere('s.youvolk = :youvolk or s.enemyvolk = :youvolk');
    			$parameters[':youvolk'] = $voelker[0];
    		}
    		if (sizeof($voelker) > 1) {
    			$query->andWhere('(s.youvolk = :youvolk and s.enemyvolk = :enemyvolk) or (s.enemyvolk = :youvolk and s.youvolk = :enemyvolk)');
    			$parameters[':youvolk'] = $voelker[0];
    			$parameters[':enemyvolk'] = $voelker[1];
    		}
    	}
    	
    	if ($filter->getSpieler() != null) {
    		$spieler = $filter->getSpieler()->toArray();
    		
    		if (sizeof($spieler) == 1) {
    			$query->andWhere('s.you = :you or s.enemy = :you');
    			$parameters[':you'] = $spieler[0];
    		}
    		if (sizeof($spieler) > 1) {
    			$query->andWhere('(s.you = :you and s.enemy = :enemy) or (s.enemy = :you and s.you = :enemy)');
    			$parameters[':you'] = $spieler[0];
    			$parameters[':enemy'] = $spieler[1];
    		}
    	}
    	
    	if ($filter->getMission() != null) {
    		$missions = $filter->getMission();
    		$missionstring = "(s.mission = ".$missions[0]->getId().")";
    		unset($missions[0]);
    		foreach ($missions as $m) {
    			$missionstring .= " or (s.mission = ".$m->getId().")";
    		}
    		$query->andWhere($missionstring);
    	}
    	
    	$query->setParameters($parameters);
    	$entities = $query->getQuery()->getResult();
  	
    	return $this->render('BinaerpilotenLigaBundle:Spiel:index.html.twig',
    			array('entities' => $entities)
    	);
    	
    }
}
