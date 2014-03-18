<?php

namespace Binaerpiloten\LigaBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Binaerpiloten\LigaBundle\Entity\User;

/**
 * User controller.
 *
 * @Route("/user")
 */
class UserController extends Controller
{

    /**
     * Lists all User entities.
     *
     * @Route("/", name="user")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BinaerpilotenLigaBundle:User')->findAll();
        uasort($entities, function($a, $b) {
											    	if ($a->evaluateRank() == $b->evaluateRank()) return 0;
											    	return ($a->evaluateRank() < $b->evaluateRank()) ? 1 : -1;
											    }
				);

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a User entity.
     *
     * @Route("/{id}", name="user_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BinaerpilotenLigaBundle:User')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        return array(
            'entity'      => $entity,
        );
    }
    /**
     * Finds and displays a User entity.
     *
     * @Route("/friend/{id}", name="user_friend")
     * @Method("GET")
     * @Template()
     */
    public function newFriendAction($id) {
    	
    	$em = $this->getDoctrine()->getManager();
    	
    	$user = $this->getUser();
    	$friend =$em->getRepository('BinaerpilotenLigaBundle:User')->find($id);
    	
			$user->addFreunde($friend);
			$em->flush();
			
			return $this->redirect($this->generateUrl('user_show', array('id' => $user->GetId())));
    }
    
    /**
     * Finds and displays a User entity.
     *
     * @Route("/unfriend/{id}", name="user_unfriend")
     * @Method("GET")
     * @Template()
     */
    public function removeFriendAction($id) {
    	 
    	$em = $this->getDoctrine()->getManager();
    	 
    	$user = $this->getUser();
    	$friend =$em->getRepository('BinaerpilotenLigaBundle:User')->find($id);
    	 
    	$user->removeFreunde($friend);
    	$em->flush();
    		
    	return $this->redirect($this->generateUrl('user_show', array('id' => $user->GetId())));
    }
    /* =========================== Helpers here ========================== */
    
}
